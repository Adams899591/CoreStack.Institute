import React, { useState } from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, Alert } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import * as ImagePicker from 'expo-image-picker';

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  white: '#ffffff',
};

export const ProfileHeader = ({ user}) => {
  const [profileImage, setProfileImage] = useState(
    'https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=200&h=200&auto=format&fit=crop'
  );

  // Handles both camera and gallery image picking
  const handlePickImage = async (useCamera) => {
    const permissionResult = useCamera 
      ? await ImagePicker.requestCameraPermissionsAsync()
      : await ImagePicker.requestMediaLibraryPermissionsAsync();

    if (!permissionResult.granted) {
      Alert.alert(
        "Permission Denied", 
        `We need permission to access your ${useCamera ? 'camera' : 'photos'} to update your profile.`
      );
      return;
    }

    const result = useCamera 
      ? await ImagePicker.launchCameraAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 })
      : await ImagePicker.launchImageLibraryAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 });

    if (!result.canceled) {
      setProfileImage(result.assets[0].uri);
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
        <TouchableOpacity style={styles.cameraBtn} onPress={triggerImageOptions}>
          <Ionicons name="camera" size={16} color={colors.white} />
        </TouchableOpacity>
      </View>
      <Text style={styles.userName}>{user.user.name}</Text>
      <Text style={styles.userMatric}>{user.matric_number}</Text>
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
  avatarContainer: { marginBottom: 12 },
  avatar: {
    width: 80,
    height: 80,
    borderRadius: 40,
    borderWidth: 3,
    borderColor: colors.gold,
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