import { Drawer } from "expo-router/drawer";
import { GlobalHeader } from "../../components/GlobalHeader";


export default function DrawerLayout() {
  return (
    <Drawer
      screenOptions={{
        headerShown: true, // Show the header
        header: () => <GlobalHeader />, // Use our custom GlobalHeader component
      }}
    >


      {/* This Drawer.Screen represents the (tabs) group, which will then render your tab navigator */}
      <Drawer.Screen name="(tabs)" options={{ drawerLabel: 'Home', title: 'Overview' }} />
      {/* Add other drawer screens here if you have any top-level screens in the (drawer) group */}
    </Drawer>
  );
}
 