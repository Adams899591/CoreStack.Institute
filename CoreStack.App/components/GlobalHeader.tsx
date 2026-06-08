import React from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Platform, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useNavigation } from 'expo-router';
import { DrawerActions } from '@react-navigation/native';

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
};

export function GlobalHeader() {
  const navigation = useNavigation();

  const toggleDrawer = () => {
    navigation.dispatch(DrawerActions.toggleDrawer());
  };

  return (
    <View style={styles.header}>
      <View style={styles.leftSection}>
        <TouchableOpacity onPress={toggleDrawer} style={styles.menuButton}>
          <Ionicons name="menu-outline" size={28} color="#ffffff" />
        </TouchableOpacity>
        <Text style={styles.brandName}>CoreStack</Text>
      </View>

      <TouchableOpacity style={styles.notificationContainer}>
        <Ionicons name="notifications-outline" size={26} color="#ffffff" />
        <View style={styles.badge}>
          <Text style={styles.badgeText}>3</Text>
        </View>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  header: { 
    backgroundColor: colors.darkBlue, 
    paddingHorizontal: 20, 
    paddingTop: Platform.OS === 'ios' ? 60 : 45, 
    paddingBottom: 20, 
    flexDirection: 'row', 
    justifyContent: 'space-between', 
    alignItems: 'center',
  },
  leftSection: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  menuButton: {
    marginRight: 15,
  },
  brandName: { 
    color: '#ffffff', 
    fontSize: 22, 
    fontWeight: 'bold', 
    letterSpacing: 1 
  },
  notificationContainer: { padding: 5 },
  badge: { 
    position: 'absolute', 
    top: 0, 
    right: 0, 
    backgroundColor: '#ff4d4d', 
    borderRadius: 10, 
    width: 18, 
    height: 18, 
    justifyContent: 'center', 
    alignItems: 'center', 
    borderWidth: 1.5, 
    borderColor: colors.darkBlue 
  },
  badgeText: { color: 'white', fontSize: 10, fontWeight: 'bold' },
});