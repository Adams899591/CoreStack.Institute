import React, { useEffect } from 'react';
import { Platform } from 'react-native';
import { Tabs } from 'expo-router';
import { Ionicons } from "@expo/vector-icons";
import * as NavigationBar from 'expo-navigation-bar';

export default function TabLayout() {

  useEffect(() => {
    if (Platform.OS != 'android') return; 

    const setNavBarStyles = async () => {
      // Setting position to absolute allows the app to draw behind the system bar,
      // making the color reach the very bottom edge of the device.
      await NavigationBar.setPositionAsync('absolute');
      await NavigationBar.setBackgroundColorAsync('#1A2B4C');
      await NavigationBar.setButtonStyleAsync('light');
    };
    setNavBarStyles();
  }, []); // Empty dependency array means this effect runs once after the initial render

  return (
    <Tabs
      screenOptions={{
        tabBarActiveTintColor: "#D4AF37",
        tabBarInactiveTintColor: "#ffffff" ,
        headerShown: false,
        tabBarStyle: {
          backgroundColor:  "#1A2B4C",
          borderTopWidth: 0,
          height: 70,
          paddingBottom: 12,
          paddingTop: 10,
          elevation: 20,
          shadowColor: '#000',
          shadowOffset: { width: 0, height: -4 },
          shadowOpacity: 0.05,
          shadowRadius: 8,
        },
        tabBarLabelStyle: {
          fontSize: 12,
          fontWeight: "500", 
        },
      }}>
      <Tabs.Screen
        name="home"
        options={{
          title: "Home",
          tabBarIcon: ({ color, focused }) => <Ionicons name={focused ? "home" : "home-outline"} size={24} color={color} />,
        }}
      />
      <Tabs.Screen
        name="courses"
        options={{
          title: "Courses",
          tabBarIcon: ({ color, focused }) => <Ionicons name={focused ? "school" : "school-outline"} size={24} color={color} />,
        }}
      />
      <Tabs.Screen
        name="profile"
        options={{
          title: "Profile",
          tabBarIcon: ({ color, focused }) => <Ionicons name={focused ? "person" : "person-outline"} size={24} color={color} />,
        }}
      />
      <Tabs.Screen
        name="qr-id"
        options={{
          title: "My QR ID",
          tabBarIcon: ({ color, focused }) => <Ionicons name={focused ? "qr-code" : "qr-code-outline"} size={24} color={color} />,
        }}
      />

    </Tabs>
  );
}
