import React, { useState } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, Alert, ActivityIndicator } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import * as ImagePicker from 'expo-image-picker';
import * as FileSystem from 'expo-file-system/legacy';
import axios from 'axios';
import { API_URL, supabase } from "../../server/config"; // Imports configured client & URL

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  white: '#ffffff',
};



export const ProfileHeader = ({ user }) => {
  const [profileImage, setProfileImage] = useState(
    user?.user?.profile_url 
  );
  const [profilePublicId, setProfilePublicId] = useState(
    user?.user?.profile_public_id || null
  );
  const [uploadStatus, setUploadStatus] = useState(null); // 'loading' | 'success' | 'error'

  const BUCKET_NAME = 'CoreStack-lnstitute';

  // Helper to convert base64 to Uint8Array for Supabase upload
  const base64ToUint8Array = (base64) => {
    const binaryString = typeof atob === 'function' ? atob(base64) : Buffer.from(base64, 'base64').toString('binary');
    const len = binaryString.length;
    const bytes = new Uint8Array(len);
    for (let i = 0; i < len; i++) {
      bytes[i] = binaryString.charCodeAt(i);
    }
    return bytes;
  };

  // Upload image to Supabase Bucket
  const uploadProfileImage = async (uri) => {
    try {
      const extension = uri.split('.').pop().split('?')[0] || 'png';
      const filename = `${Date.now()}.${extension}`;
      const filePath = `profile_image/${filename}`;

      const base64Data = await FileSystem.readAsStringAsync(uri, {
        encoding: 'base64',
      });
      const bytes = base64ToUint8Array(base64Data);

      const { data, error } = await supabase.storage.from(BUCKET_NAME).upload(filePath, bytes, {
        contentType: `image/${extension}`,
        upsert: false,
      });

      if (error) {
        // console.error('Supabase upload failed:', error.message);
        return null;
      }

      const { data: publicUrlData } = supabase.storage.from(BUCKET_NAME).getPublicUrl(filePath);
      return { 
        publicUrl: publicUrlData.publicUrl, 
        filePath: filePath 
      };
    } catch (err) {
      // console.error('Error during image upload:', err.message || err);
      return null;
    }
  };

  // Send uploaded image details to Laravel Backend
  const sendUserImageToBackend = async (url, publicId) => {
    try {
      const userId = user?.user?.id;
      
      const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/user/upload-profile-image/${userId}`, {
        profile_url: url,
        profile_public_id: publicId,
      });

      console.log(JSON.stringify(response, null, 2));
      

      const responseData = response.data;   
      return responseData === "success" || responseData.status === "success";
      
      
    } catch (error) {
      // console.error('Backend sync failed:', error);
      return false;
    }
  };

  // Main image picking & upload handler
  const handlePickImage = async (useCamera) => {
    const permissionResult = useCamera 
      ? await ImagePicker.requestCameraPermissionsAsync()
      : await ImagePicker.requestMediaLibraryPermissionsAsync();

    if (!permissionResult.granted) {
      Alert.alert(
        "Permission Denied", 
        `Permission is required to access your ${useCamera ? 'camera' : 'photos'}.`
      );
      return;
    }

    const result = useCamera 
      ? await ImagePicker.launchCameraAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 })
      : await ImagePicker.launchImageLibraryAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 });

    if (!result.canceled) {
      const localUri = result.assets[0].uri;
      const oldFilePath = profilePublicId;

      setUploadStatus('loading');

      // 1. Upload new image to Supabase
      const uploadResult = await uploadProfileImage(localUri);

      if (uploadResult) {
        const { publicUrl, filePath } = uploadResult;

        // 2. Sync image details with backend
        const isBackendUpdated = await sendUserImageToBackend(publicUrl, filePath);

        if (isBackendUpdated) {
          setProfileImage(publicUrl);
          setProfilePublicId(filePath);
          setUploadStatus('success');

          // 3. Remove old image from Supabase
          if (oldFilePath) {
            await supabase.storage.from(BUCKET_NAME).remove([oldFilePath]);
          }
        } else {
          setUploadStatus('error');
          // Cleanup newly uploaded file if backend fails
          await supabase.storage.from(BUCKET_NAME).remove([filePath]);
        }
      } else {
        setUploadStatus('error');
      }

      setTimeout(() => setUploadStatus(null), 2000);
    }
  };

  const triggerImageOptions = () => {
    Alert.alert("Profile Photo", "Choose an option", [
      { text: "Take Photo", onPress: () => handlePickImage(true) },
      { text: "Choose from Gallery", onPress: () => handlePickImage(false) },
      { text: "Cancel", style: "cancel" }
    ]);
  };

  return (
    <View style={styles.header}>
      <View style={styles.avatarContainer}>
        <Image source={{ uri: profileImage }} style={styles.avatar} />

        {/* Upload Status Overlay */}
        {uploadStatus && (
          <View style={styles.uploadOverlay}>
            {uploadStatus === 'loading' && <ActivityIndicator size="large" color={colors.gold} />}
            {uploadStatus === 'success' && <Ionicons name="checkmark-circle" size={40} color="#10B981" />}
            {uploadStatus === 'error' && <Ionicons name="close-circle" size={40} color="#FF3B30" />}
          </View>
        )}

        <TouchableOpacity 
          style={styles.cameraBtn} 
          onPress={triggerImageOptions} 
          disabled={!!uploadStatus}
        >
          <Ionicons name="camera" size={16} color={colors.white} />
        </TouchableOpacity>
      </View>

      <Text style={styles.userName}>{user?.user?.name || user?.name || 'Guest User'}</Text>
      <Text style={styles.userMatric}>{user?.matric_number || 'N/A'}</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  header: {
    padding: 20,
    paddingVertical: 40,
    backgroundColor: colors.darkBlue,
    alignItems: 'center',
    borderBottomWidth: 8,
    borderBottomColor: colors.gold,
  },
  avatarContainer: { 
    marginBottom: 12,
    position: 'relative',
  },
  avatar: {
    width: 80,
    height: 80,
    borderRadius: 40,
    borderWidth: 3,
    borderColor: colors.gold,
  },
  uploadOverlay: {
    ...StyleSheet.absoluteFillObject,
    backgroundColor: 'rgba(0,0,0,0.5)',
    borderRadius: 40,
    justifyContent: 'center',
    alignItems: 'center',
  },
  cameraBtn: {
    position: 'absolute',
    bottom: 0,
    right: 0,
    backgroundColor: colors.gold,
    width: 28,
    height: 28,
    borderRadius: 14,
    justifyContent: 'center',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: colors.darkBlue,
  },
  userName: { color: colors.white, fontSize: 18, fontWeight: 'bold' },
  userMatric: { color: colors.lightText, fontSize: 14, marginTop: 4 },
});









