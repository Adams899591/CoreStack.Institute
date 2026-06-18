import React, { useState } from 'react';
import {
  View,
  Text,
  TextInput,
  TouchableOpacity,
  StyleSheet,
  KeyboardAvoidingView,
  Platform,
  StatusBar,
  Alert,
  SafeAreaView,
} from 'react-native';
import { Link, useRouter } from "expo-router";
import { Ionicons } from '@expo/vector-icons';
import * as LocalAuthentication from 'expo-local-authentication';
import * as Haptics from 'expo-haptics';
import { useSafeAreaInsets } from 'react-native-safe-area-context';

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  bgGray: '#f8f9fa',
  white: '#ffffff',
  text: '#1c1917',
  muted: '#78716c',
  border: '#e7e5e4'
};

const Login = () => {
  const [metricNumber, setMetricNumber] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
 
  const router = useRouter();
  const insets = useSafeAreaInsets();

  const handleBiometricLogin = async () => {
    try {
      const hasHardware = await LocalAuthentication.hasHardwareAsync();
      const isEnrolled = await LocalAuthentication.isEnrolledAsync();

      if (!hasHardware || !isEnrolled) {
        Alert.alert('Not Available', 'Biometric authentication is not supported or set up on this device.');
        return;
      }

      const result = await LocalAuthentication.authenticateAsync({
        promptMessage: 'Login to CoreStack',
        fallbackLabel: 'Enter Password',
      });

      if (result.success) {
        Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
        router.replace('/(tabs)/home');
      }
    } catch (error) {
      Alert.alert('Error', 'An unexpected error occurred during biometric login.');
    }
  };

  return (
    <>
    <StatusBar barStyle="light-content" backgroundColor="#1A2B4C" /> 
    <View style={[styles.container, { paddingTop: insets.top, paddingBottom: insets.bottom }]}> 
      {/* <StatusBar barStyle="light-content" backgroundColor={colors.darkBlue} /> */}

      <View style={styles.topHeader}>
        <Text style={styles.topHeaderTitle}>CoreStack</Text>
      </View>

      <KeyboardAvoidingView
        behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
        style={styles.inner}
      >
        <View style={styles.header}>
          <Text style={styles.subtitle}>Institutional Portal Login</Text>
          <View style={styles.headerAccent} />
        </View>

        <View style={styles.form}>
          {/* Metric Number Input */}
          <Text style={styles.label}>Metric Number</Text>
          <View style={styles.inputGroup}>
            <Ionicons name="person-outline" size={20} color={colors.darkBlue} style={styles.icon} />
            <TextInput
              style={styles.input}
              placeholder="Enter your metric number"
              placeholderTextColor="#a8a29e"
              value={metricNumber}
              onChangeText={setMetricNumber}
              autoCapitalize="none"
            />
          </View>

          {/* Password Input */}
          <Text style={styles.label}>Password</Text>
          <View style={styles.inputGroup}>
            <Ionicons name="lock-closed-outline" size={20} color={colors.darkBlue} style={styles.icon} />
            <TextInput
              style={styles.input}
              placeholder="Enter your password"
              placeholderTextColor="#a8a29e"
              secureTextEntry={!showPassword}
              value={password}
              onChangeText={setPassword}
            />
            <TouchableOpacity onPress={() => setShowPassword(!showPassword)}>
              <Ionicons name={showPassword ? "eye-off-outline" : "eye-outline"} size={20} color={colors.muted} />
            </TouchableOpacity>
          </View>

          <TouchableOpacity style={styles.forgotBtn} onPress={() => router.push('/screen/forget-password')}>
            <Text style={styles.forgotText}>Forgot Password?</Text>
          </TouchableOpacity>

          {/* Action Row: Login + Fingerprint */}
          <View style={styles.actionRow}>
            <TouchableOpacity 
              style={styles.loginButton} 
              activeOpacity={0.8}
              onPress={() => router.push('/(tabs)/home')}
            >
              <Text style={styles.loginButtonText}>Sign In</Text>
            </TouchableOpacity>

            <TouchableOpacity 
              style={styles.fingerprintButton} 
              activeOpacity={0.7}
              onPress={handleBiometricLogin}
            >
              <Ionicons name="finger-print" size={28} color={colors.darkBlue} />
            </TouchableOpacity>
          </View>
        </View>

        <View style={styles.footer}>
          <Text style={styles.footerText}>Secured by CoreStack Auth</Text>
        </View>
      </KeyboardAvoidingView>
    </View>
    </>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: colors.bgGray },
  topHeader: {
    backgroundColor: colors.darkBlue,
    paddingVertical: 15,
    alignItems: 'center',
    borderBottomLeftRadius: 35,
    borderBottomRightRadius: 35,
    elevation: 10,
    shadowColor: colors.darkBlue,
    shadowOffset: { width: 0, height: 5 },
    shadowOpacity: 0.3,
    shadowRadius: 10,
  },
  topHeaderTitle: {
    color: colors.white,
    fontSize: 26,
    fontWeight: '900',
    letterSpacing: 1,
  },
  inner: { flex: 1, justifyContent: 'center', paddingHorizontal: 32 },
  header: { alignItems: 'flex-start', marginBottom: 40, marginTop: 0 },
  subtitle: { fontSize: 16, color: colors.muted, marginTop: 4, fontWeight: '500' },
  headerAccent: {
    width: 40,
    height: 4,
    backgroundColor: colors.gold,
    marginTop: 12,
    borderRadius: 2,
  },
  form: { width: '100%' },
  label: {
    fontSize: 14,
    fontWeight: '700',
    color: colors.darkBlue,
    marginBottom: 8,
    marginLeft: 4,
  },
  inputGroup: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: colors.white,
    borderWidth: 1.5,
    borderColor: colors.border,
    borderRadius: 12,
    paddingHorizontal: 16,
    marginBottom: 20,
    height: 56,
  },
  icon: { marginRight: 12 },
  input: { flex: 1, fontSize: 16, color: colors.text },
  actionRow: { flexDirection: 'row', alignItems: 'center', marginTop: 12 },
  loginButton: {
    flex: 1,
    backgroundColor: colors.darkBlue,
    height: 56,
    borderRadius: 12,
    justifyContent: 'center',
    alignItems: 'center',
    marginRight: 12,
    shadowColor: colors.darkBlue,
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.2,
    shadowRadius: 8,
    elevation: 3,
  },
  loginButtonText: { color: colors.white, fontSize: 17, fontWeight: '800', letterSpacing: 0.5 },
  fingerprintButton: {
    width: 56,
    height: 56,
    backgroundColor: colors.white,
    borderRadius: 12,
    justifyContent: 'center',
    alignItems: 'center',
    borderWidth: 1.5,
    borderColor: colors.darkBlue,
  },
  forgotBtn: { alignSelf: 'flex-end', marginBottom: 24 },
  forgotText: { color: colors.gold, fontSize: 14, fontWeight: '700' },
  footer: {
    position: 'absolute',
    bottom: 20,
    left: 0,
    right: 0,
    alignItems: 'center',
  },
  footerText: {
    color: colors.lightText,
    fontSize: 12,
    fontWeight: '500',
  },
});

export default Login;
