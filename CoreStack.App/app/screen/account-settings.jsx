import React, { useState, useContext } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity, StatusBar, TextInput, ScrollView, ActivityIndicator, Alert } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';
import { UserContext } from "../../context/UserContext";
import BiometricSetUp from '../../components/account-settings/BiometricSetUp';
import axios from "axios";

const colors = {
    primary: '#1A2B4C',
    black: '#000000',
    background: '#F8F9FA',
    white: '#FFFFFF',
    text: '#1A1A1A',
    muted: '#999',
    border: '#E0E0E0',
};

const AccountSettings = () => {
    const { user, setUser } = useContext(UserContext);
    const router = useRouter();
    const [matricNumber] = useState(user?.matric_number);
    const [newPassword, setNewPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [showPass, setShowPass] = useState(false);
    const [showConfirmPass, setShowConfirmPass] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    // Disable button if inputs are empty or loading
    const isButtonDisabled = !newPassword.trim() || !confirmPassword.trim() || isLoading;


    // Function that send request to laravel to update password
    const handleSave = async () => {
        if (newPassword !== confirmPassword) {
            Alert.alert("Error", "Passwords do not match.");
            return;
        }
        setIsLoading(true); // Set loading state to true before making the API call

        // Section that send request to laravel to update password
        try {
            const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/auth/update-password/${user.user.id}`, {
              password: newPassword.trim(),
            });
              
            const res = response.data;
            console.log(res);
            
            if(res.status === "success"){
              console.log(res.message);
                // Empty the form fields after successful login
              
                // setPassword("");
                // setConfirmPassword("");
            // setIsLoading(false);
            Alert.alert("Success", "Password updated successfully!");
            setNewPassword('');
            setConfirmPassword('');

            }
        
        } catch (error) {
            // Check if it's a network error
            if (error.request && !error.response) {
            Alert.alert("API Error", "Network Error: Could not connect to the server. Please check your internet connection and try again.");
            } else if (error.response) {
            // Handle API errors (e.g., validation)
            const apiError = error.response.data?.message || "An unexpected error occurred.";
            Alert.alert("API Error", apiError);
            console.log("API Error:", error.response.data);
            } else {
            // Other errors
            Alert.alert("API Error", "An unexpected error occurred during login.");
            console.error("Login failed:", error.message);
            }
            console.log(error);
            
        }finally{
        setIsLoading(false);
        }
    };

    return (
        <SafeAreaView style={styles.container}>
            <StatusBar barStyle="light-content" backgroundColor={colors.primary} />

            {/* Header */}
            <View style={styles.header}>
                <View style={styles.headerMain}>
                    <TouchableOpacity onPress={() => router.back()} style={styles.backButton}>
                        <Ionicons name="arrow-back" size={26} color={colors.white} />
                    </TouchableOpacity>
                    <Text style={styles.headerTitle}>Account Settings</Text>
                </View>
            </View>

            <ScrollView contentContainerStyle={styles.content} showsVerticalScrollIndicator={false}>
                {/* General Information Section */}
                <Text style={styles.sectionTitle}>General Information</Text>
                <View style={styles.card}>
                    <Text style={styles.inputLabel}>Matric Number</Text>
                    <View style={[styles.inputContainer, styles.readOnlyInput]}>
                        <Ionicons name="card-outline" size={20} color={colors.muted} />
                        <TextInput style={styles.textInput} value={matricNumber} editable={false} />
                    </View>
                </View>

                {/* Security Section */}
                <Text style={styles.sectionTitle}>Security & Privacy</Text>
                <View style={styles.card}>
                    <Text style={styles.inputLabel}>New Password</Text>
                    <View style={styles.inputContainer}>
                        <Ionicons name="lock-closed-outline" size={20} color={colors.primary} />
                        <TextInput
                            style={styles.textInput}
                            placeholder="••••••••"
                            secureTextEntry={!showPass}
                            value={newPassword}
                            onChangeText={setNewPassword}
                        />
                        <TouchableOpacity onPress={() => setShowPass(!showPass)}>
                            <Ionicons name={showPass ? "eye-off-outline" : "eye-outline"} size={20} color={colors.muted} />
                        </TouchableOpacity>
                    </View>

                    <View style={{ height: 15 }} />

                    <Text style={styles.inputLabel}>Confirm New Password</Text>
                    <View style={styles.inputContainer}>
                        <Ionicons name="shield-checkmark-outline" size={20} color={colors.primary} />
                        <TextInput
                            style={styles.textInput}
                            placeholder="••••••••"
                            secureTextEntry={!showConfirmPass}
                            value={confirmPassword}
                            onChangeText={setConfirmPassword}
                        />
                        <TouchableOpacity onPress={() => setShowConfirmPass(!showConfirmPass)}>
                            <Ionicons name={showConfirmPass ? "eye-off-outline" : "eye-outline"} size={20} color={colors.muted} />
                        </TouchableOpacity>
                    </View>
                </View>

                {/* Preferences Section */}
                <Text style={styles.sectionTitle}>App Preferences</Text>
                
                {/* Self-contained Biometric Component */}
                <BiometricSetUp  user={user}/>

                <TouchableOpacity
                    style={[styles.saveButton, isButtonDisabled && styles.saveButtonDisabled]}
                    onPress={handleSave}
                    disabled={isButtonDisabled}
                >
                    {isLoading ? (
                        <ActivityIndicator color={colors.white} />
                    ) : (
                        <Text style={styles.saveButtonText}>Update Password</Text>
                    )}
                </TouchableOpacity>
                <View style={{ height: 40 }} />
            </ScrollView>
        </SafeAreaView>
    );
};

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: colors.background,
    },
    header: {
        backgroundColor: colors.primary,
        paddingHorizontal: 25,
        paddingTop: 40,
        paddingBottom: 25,
    },
    headerMain: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between',
    },
    backButton: {
        marginLeft: -5,
    },
    headerTitle: {
        fontSize: 24,
        fontWeight: '900',
        color: colors.white,
    },
    content: {
        padding: 20,
    },
    sectionTitle: {
        fontSize: 14,
        fontWeight: 'bold',
        color: colors.muted,
        textTransform: 'uppercase',
        letterSpacing: 1,
        marginBottom: 10,
        marginTop: 5,
    },
    card: {
        backgroundColor: colors.white,
        borderRadius: 16,
        padding: 20,
        marginBottom: 20,
        elevation: 2,
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 2 },
        shadowOpacity: 0.05,
        shadowRadius: 5,
    },
    inputLabel: {
        fontSize: 13,
        color: colors.primary,
        fontWeight: '700',
        marginBottom: 6,
    },
    inputContainer: {
        flexDirection: 'row',
        alignItems: 'center',
        backgroundColor: colors.white,
        borderWidth: 1,
        borderColor: colors.border,
        borderRadius: 10,
        paddingHorizontal: 12,
        height: 50,
    },
    textInput: {
        flex: 1,
        marginLeft: 10,
        fontSize: 16,
        color: colors.text,
    },
    readOnlyInput: {
        backgroundColor: '#F2F4F7',
        borderColor: 'transparent',
    },
    saveButton: {
        backgroundColor: colors.black,
        height: 55,
        borderRadius: 12,
        justifyContent: 'center',
        alignItems: 'center',
        marginTop: 10,
        elevation: 4,
        shadowColor: colors.black,
        shadowOffset: { width: 0, height: 4 },
        shadowOpacity: 0.3,
        shadowRadius: 5,
    },
    saveButtonText: {
        color: colors.white,
        fontSize: 17,
        fontWeight: 'bold',
    },
    saveButtonDisabled: {
        backgroundColor: '#CCC',
        shadowOpacity: 0,
        elevation: 0,
    },
});

export default AccountSettings;