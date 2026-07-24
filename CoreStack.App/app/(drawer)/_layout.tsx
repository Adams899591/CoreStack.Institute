import React, { useContext } from 'react';
import { View, Text, StyleSheet, TouchableOpacity } from 'react-native';
import { Drawer } from "expo-router/drawer";
import { DrawerContentScrollView, DrawerItemList, DrawerItem } from '@react-navigation/drawer';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';
import { GlobalHeader } from "../../components/GlobalHeader";
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import { UserContext } from '@/context/UserContext';
import { ProfileHeader } from '../../components/drawer/ProfileHeader';

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  white: '#ffffff',
  danger: '#dc3545',
};

function CustomDrawerContent(props) {
  const { user } = useContext(UserContext);
  const router = useRouter();
  const insets = useSafeAreaInsets();

  return (
    <View style={{ flex: 1 }}>
      <DrawerContentScrollView  
        {...props} 
        contentContainerStyle={{ backgroundColor: colors.white, paddingTop: 0 }}
      >
        {/* Profile Header Component .props*/}
        <ProfileHeader 
          user={user}
        />

        {/* Navigation Items Area */}
        <View style={styles.itemsContainer}>
          <DrawerItemList {...props} />
          
          <DrawerItem
            label="Time Table"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="calendar-outline" size={size} color={colors.gold} />
            )}
            onPress={() => router.push("/screen/time-table")}
          />

          <DrawerItem
            label="Account Settings"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="settings-outline" size={size} color={colors.gold} />
            )}
            onPress={() => router.push("/screen/account-settings")}
          />

          <DrawerItem
            label="Group Chat"
            labelStyle={styles.drawerLabel}
            icon={({ size }) => (
              <Ionicons name="chatbox-outline" size={size} color={colors.gold} />
            )}
            onPress={() => router.push("/screen/chat")}
          />
        </View>
      </DrawerContentScrollView>

      {/* Logout Section */}
      <View style={[styles.footer, { paddingBottom: 20 + insets.bottom }]}>
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
          borderRadius: 0,
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
    </Drawer>
  );
}

const styles = StyleSheet.create({
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