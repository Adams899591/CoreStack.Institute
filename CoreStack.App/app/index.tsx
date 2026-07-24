import React, { useState, useEffect, useContext } from 'react';
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
  ScrollView,
  ActivityIndicator,
} from 'react-native';
import { useRouter } from "expo-router";
import { Ionicons } from '@expo/vector-icons';
import * as LocalAuthentication from 'expo-local-authentication';
import * as Haptics from 'expo-haptics';
import * as SecureStore from 'expo-secure-store';
import { useSafeAreaInsets } from 'react-native-safe-area-context';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { UserContext } from '../context/UserContext';
import axios from "axios";

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  bgGray: '#f8f9fa',
  white: '#ffffff',
  text: '#1c1917',
  muted: '#78716c',
  border: '#e7e5e4',
  disabled: '#94a3b8'
};

const Login = () => {
  const { user, setUser } = useContext(UserContext);
  const [metricNumber, setMetricNumber] = useState('');
  const [password, setPassword] = useState('');
  const [showPassword, setShowPassword] = useState(false);
  const [showBiometric, setShowBiometric] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [errorMessage , setErrorMessage] = useState("");
  const [successMessage , setSuccessMessage] = useState("");
 
  const router = useRouter();
  const insets = useSafeAreaInsets();

  useEffect(() => {
    checkBiometric();
  }, []);

  // Function to check Biometric to determine if it will be visible to user or not 
  const checkBiometric = async () => {
    try {
      const compatible = await LocalAuthentication.hasHardwareAsync();
      const enrolled = await LocalAuthentication.isEnrolledAsync();
      const types = await LocalAuthentication.supportedAuthenticationTypesAsync();
      const biometricToken = await SecureStore.getItemAsync("biometric_token");
      
      if (compatible && enrolled && biometricToken && types.length > 0) {
        setShowBiometric(true);
      } else {
        setShowBiometric(false);
      }
    } catch (error) {
      console.log(error);
      setShowBiometric(false);
    }
  };

  // Function to handle User login
  const handleLogin = async () => {

    setIsLoading(true);
    setErrorMessage("");
    setSuccessMessage("");

   
    try {

           setIsLoading(true); // Set loading state to true before making the API call
            const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/auth/login`, {
              matric_number: metricNumber.trim(),
              password: password.trim(),
            });
              
            const res = response.data;
            // console.log(res);
            
            if(res.status === "success"){
                console.log(JSON.stringify(res.user, null, 2));    //Note: on success make it return a relationship from the student table to the user table    

                // Empty the form fields after successful login
                setMetricNumber("");
                setPassword("");

                // Set success message
                setSuccessMessage(res.message);

                // Save the user data to AsyncStorage for persistence across app restarts
                await AsyncStorage.setItem("user", JSON.stringify(res.user));

                // Save the user data to global context for access across the app
                setUser(res.user);

                // Redirect to login page after a short delay (e.g., 3 seconds)
                setTimeout(() => {
                  setErrorMessage(""); // Clear error message after redirect
                  setSuccessMessage(""); // Clear success message after redirect
                  router.push("/home");
                }, 3000);
            }
        
    } catch (error) {
        // Check if it's a network error
        if (error.request && !error.response) {
          setErrorMessage("Network Error: Could not connect to the server. Please check your internet connection and try again.");
        } else if (error.response) {
          // Handle API errors (e.g., validation)
          const apiError = error.response.data?.message || "An unexpected error occurred.";
          setErrorMessage(apiError);
          console.log("API Error:", error.response.data);
        } else {
          // Other errors
          setErrorMessage("An unexpected error occurred during login.");
          console.error("Login failed:", error.message);
        }
        console.log(error);
        
    }finally{
      setIsLoading(false);
    }

  };


  // Function to handle Biometric login 
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

        // 2. READ (Key)
        const token = await SecureStore.getItemAsync('biometric_token');

        try {

              setIsLoading(true); // Set loading state to true before making the API call
                const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/auth/biometric-login`, {
                biometric_token: token,
                });
                  
                const res = response.data;
                // console.log(res);
                
                if(res.status === "success"){
                    console.log(JSON.stringify(res.user, null, 2));  
                    
                    //Note: on success make it return a relationship from the student table to the user table    
                    setSuccessMessage(res.message);

                    // Save the user data to AsyncStorage for persistence across app restarts
                    await AsyncStorage.setItem("user", JSON.stringify(res.user));

                    // Save the user data to global context for access across the app
                    setUser(res.user);

                    // Redirect to login page after a short delay (e.g., 3 seconds)
                    setTimeout(() => {
                      setErrorMessage(""); // Clear error message after redirect
                      setSuccessMessage(""); // Clear success message after redirect
                      router.push("/home");
                    }, 3000);
                }
            
        } catch (error) {
            // Check if it's a network error
            if (error.request && !error.response) {
              setErrorMessage("Network Error: Could not connect to the server. Please check your internet connection and try again.");
            } else if (error.response) {
              // Handle API errors (e.g., validation)
              const apiError = error.response.data?.message || "An unexpected error occurred.";
              setErrorMessage(apiError);
              console.log("API Error:", error.response.data);
            } else {
              // Other errors
              setErrorMessage("An unexpected error occurred during login.");
              console.error("Login failed:", error.message);
            }
            console.log(error);
            
        }finally{
          setIsLoading(false);
        }

      }
    } catch (error) {
      Alert.alert('Error', 'An unexpected error occurred during biometric login.');
    }
  };

  const isFormInvalid = !metricNumber.trim() || !password.trim() || isLoading;

  return (
    <>
      <StatusBar barStyle="light-content" backgroundColor="#1A2B4C" />

      <View style={[styles.container, { paddingTop: insets.top, paddingBottom: insets.bottom }]}> 

         {/*Header  */}
        <View style={styles.topHeader}>
          <Text style={styles.topHeaderTitle}>CoreStack</Text>
        </View>

      {/* Top Banner Error Display */}
      {errorMessage ? (
        <View className="bg-red-50 border-b border-red-200 px-6 py-3 flex-row items-center justify-center space-x-2">
          <Ionicons name="alert-circle-outline" size={18} color="#dc2626" />
          <Text className="text-red-600 font-semibold text-center text-sm flex-1">
            {errorMessage}
          </Text>
        </View>
      ) : null}

      {/* Top Banner Success Display */}
      {successMessage ? (
        <View className="bg-green-50 border-b border-green-200 px-6 py-3 flex-row items-center justify-center space-x-2">
          <Ionicons name="checkmark-circle-outline" size={18} color="#16a34a" />
          <Text className="text-green-600 font-semibold text-center text-sm flex-1">
            {successMessage}
          </Text>
        </View>
      ) : null}

        <KeyboardAvoidingView
          behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
          style={styles.inner}
        >
          <ScrollView 
            contentContainerStyle={styles.scrollContent}
            showsVerticalScrollIndicator={false}
            keyboardShouldPersistTaps="handled"
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
                  editable={!isLoading}
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
                  editable={!isLoading}
                />
                <TouchableOpacity onPress={() => setShowPassword(!showPassword)}>
                  <Ionicons name={showPassword ? "eye-off-outline" : "eye-outline"} size={20} color={colors.muted} />
                </TouchableOpacity>
              </View>

              {/* Forget Passsword */}
              <TouchableOpacity 
                style={styles.forgotBtn} 
                onPress={() => router.push('/screen/forget-password')}
                disabled={isLoading}
              >
                <Text style={styles.forgotText}>Forgot Password?</Text>
              </TouchableOpacity>

              {/* Action Row: Login + Optional Fingerprint */}
              <View style={styles.actionRow}>
                <TouchableOpacity 
                  style={[
                    styles.loginButton, 
                    isFormInvalid && styles.disabledButton,
                    !showBiometric && { marginRight: 0 } // Takes full width if biometric is hidden
                  ]} 
                  activeOpacity={0.8}
                  onPress={handleLogin}
                  disabled={isFormInvalid}
                >
                  {isLoading ? (
                    <ActivityIndicator color={colors.white} />
                  ) : (
                    <Text style={styles.loginButtonText}>Sign In</Text>
                  )}
                </TouchableOpacity>

                {showBiometric && (
                  <TouchableOpacity 
                    style={styles.fingerprintButton} 
                    activeOpacity={0.7}
                    onPress={handleBiometricLogin}
                    disabled={isLoading}
                  >
                    <Ionicons name="finger-print" size={28} color={colors.darkBlue} />
                  </TouchableOpacity>
                )}
              </View>
            </View>

            <View style={styles.footer}>
              <Text style={styles.footerText}>Secured by CoreStack Auth</Text>
            </View>
          </ScrollView>
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
  inner: { flex: 1 },
  scrollContent: {
    flexGrow: 1,
    justifyContent: 'center',
    paddingHorizontal: 32,
    paddingVertical: 20,
  },
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
  disabledButton: {
    backgroundColor: colors.disabled,
    elevation: 0,
    shadowOpacity: 0,
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
    marginTop: 40,
    alignItems: 'center',
  },
  footerText: {
    color: colors.lightText,
    fontSize: 12,
    fontWeight: '500',
  },
});

export default Login;