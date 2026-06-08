import React from 'react';
import { View, Text, StyleSheet, Image, TouchableOpacity, Alert } from 'react-native';
import { Drawer } from "expo-router/drawer";
import { DrawerContentScrollView, DrawerItemList, DrawerItem } from '@react-navigation/drawer';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';
import * as ImagePicker from 'expo-image-picker';
import { GlobalHeader } from "../../components/GlobalHeader";

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  white: '#ffffff',
  danger: '#dc3545',
  lightGray: '#f4f4f4'
};

function CustomDrawerContent(props: any) {
  const router = useRouter();

  // Mock student data
  const student = {
    name: "Usman Adams",
    matric: "CS-2024-0882",
  };

  const [profileImage, setProfileImage] = React.useState('https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=200&h=200&auto=format&fit=crop');

  // Handles both camera and gallery image picking based on the user's choice
  const handlePickImage = async (useCamera: boolean) => {
    const permissionResult = useCamera 
      ? await ImagePicker.requestCameraPermissionsAsync()
      : await ImagePicker.requestMediaLibraryPermissionsAsync();

      // Check if permission was granted
    if (!permissionResult.granted) {
      Alert.alert("Permission Denied", `We need permission to access your ${useCamera ? 'camera' : 'photos'} to update your profile.`);
      return;
    }

    // Launch the appropriate image picker based on the user's choice
    const result = useCamera 
      ? await ImagePicker.launchCameraAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 })
      : await ImagePicker.launchImageLibraryAsync({ allowsEditing: true, aspect: [1, 1], quality: 0.7 });

    if (!result.canceled) {
      setProfileImage(result.assets[0].uri);
    }
  };

  // Presents options to the user for updating their profile photo
  const triggerImageOptions = () => {
    Alert.alert("Profile Photo", "Choose an option", [
      { text: "Take Photo", onPress: () => handlePickImage(true) },
      { text: "Choose from Gallery", onPress: () => handlePickImage(false) },
      { text: "Cancel", style: "cancel" }
    ]);
  };

  return (
    <View style={{ flex: 1 }}>
      <DrawerContentScrollView  // 
        {...props} 
        contentContainerStyle={{ backgroundColor: colors.white, paddingTop: 0 }}
      >
        {/* Profile Header Section */}
        <View style={styles.header}>
          <View style={styles.avatarContainer}>
            <Image 
              source={{ uri: profileImage }} 
              style={styles.avatar} 
            />
            <TouchableOpacity style={styles.cameraBtn} onPress={triggerImageOptions}>
              <Ionicons name="camera" size={16} color={colors.white} />
            </TouchableOpacity>
          </View>
          <Text style={styles.userName}>{student.name}</Text>
          <Text style={styles.userMatric}>{student.matric}</Text>
        </View>

        {/* Navigation Items Area */}
        <View style={styles.itemsContainer}>
          <DrawerItemList {...props}  />
          
          <DrawerItem
            label="Time Table"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="calendar-outline" size={size} color={colors.gold} />
            )}
            onPress={() => {
              router.push("pages/navigate/time-table");
            }}
          />

          <DrawerItem
            label="Account Settings"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="settings-outline" size={size} color={colors.gold} />
            )}
            onPress={() => {
              router.push("pages/navigate/account-settings");
            }}
          />

          {/* <DrawerItem
            label="Account Settings"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="settings-outline" size={size} color={colors.gold} />
            )}
            onPress={() => {
              console.log('Navigating to Settings');
            }}
          /> */}

        </View>
      </DrawerContentScrollView>

      {/* Logout Section */}
      <View style={styles.footer}>
        <TouchableOpacity 
          style={styles.logoutBtn} 
          onPress={() => console.log('User logging out...')}
        >
          <Ionicons name="log-out-outline" size={22} color={colors.danger} />
          <Text style={styles.logoutText}>Logout</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}

export default function DrawerLayout() {
  return (
    <Drawer
      screenOptions={{
        headerShown: true,
        header: () => <GlobalHeader />,
        drawerStyle: {
          borderRadius: 0, // Removes the rounding on the side menu edges
          width: 280,
        },
        drawerActiveTintColor: colors.gold,
        drawerInactiveTintColor: colors.darkBlue,
      }}
      drawerContent={(props) => <CustomDrawerContent {...props} />}
    >
      <Drawer.Screen 
        name="(tabs)" 
        options={{ 
          drawerLabel: 'Home', 
          title: 'Overview',
          drawerIcon: ({ color, size }) => (
            <Ionicons name="home-outline" size={size} color={color} />
          ),
        }}    
      />

      {/* <Drawer.Screen 
        name="(tab)" 
        options={{ 
          drawerLabel: 'yhhh', 
          title: 'ooooooooooo',
          drawerIcon: ({ color, size }) => (
            <Ionicons name="home-outline" size={size} color={color} />
          ),
        }}    
      /> */}

    </Drawer>
  );
}

const styles = StyleSheet.create({
  header: {
    padding: 20,
    paddingVertical: 40,
    backgroundColor: colors.darkBlue,
    alignItems: 'center',
    borderBottomWidth: 8,
    borderBottomColor: colors.gold, // The "gold bar" separator at the bottom of the blue section
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
  itemsContainer: {
    flex: 1,
    backgroundColor: colors.white,
    paddingTop: 20,
  },
  drawerLabel: { fontSize: 15, fontWeight: '600', color: colors.darkBlue },
  footer: {
    padding: 20,
    borderTopWidth: 1,
    borderTopColor: '#f0f0f0',
    backgroundColor: colors.white,
  },
  logoutBtn: { flexDirection: 'row', alignItems: 'center' },
  logoutText: { color: colors.danger, fontSize: 16, fontWeight: 'bold', marginLeft: 15 },
});
 
