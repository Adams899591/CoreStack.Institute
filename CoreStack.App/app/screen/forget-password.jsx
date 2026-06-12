import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity, StatusBar, TextInput, ScrollView, ActivityIndicator, Alert, KeyboardAvoidingView, Platform } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';

const colors = {
    darkBlue: '#1A2B4C',
    gold: '#D4AF37',
    black: '#000000',
    lightText: '#A7BCCF',
    bgGray: '#f8f9fa',
    white: '#ffffff',
    text: '#1c1917',
    muted: '#78716c',
    border: '#e7e5e4',
};

const ForgotPassword = () => {
    const router = useRouter();
    const [email, setEmail] = useState('');
    const [isLoading, setIsLoading] = useState(false);
 
    const handleResetPassword = () => {
        if (!email) {
            Alert.alert("Error", "Please enter your email address.");
            return;
        }
        
        // Simple email regex validation
        const emailRegex = /\S+@\S+\.\S+/;
        if (!emailRegex.test(email)) {
            Alert.alert("Error", "Please enter a valid email address.");
            return;
        }

        setIsLoading(true);
        // Simulate an API call to a backend like Laravel
        setTimeout(() => {
            setIsLoading(false);
            Alert.alert(
                "Success", 
                "If an account exists for this email, a reset link has been sent to your inbox.",
                [{ text: "OK", onPress: () => router.back() }]
            );
        }, 1500);
    };

    return (
        <SafeAreaView style={styles.container}>
            <StatusBar barStyle="light-content" backgroundColor={colors.darkBlue} />

            <View style={styles.topHeader}>
                <TouchableOpacity onPress={() => router.back()} style={styles.backButton}>
                    <Ionicons name="arrow-back" size={26} color={colors.white} />
                </TouchableOpacity>
                <Text style={styles.topHeaderTitle}>Forgot Password</Text>
                <View style={{ width: 36 }} /> 
            </View>

            <KeyboardAvoidingView 
                behavior={Platform.OS === "ios" ? "padding" : "height"}
                style={{ flex: 1 }}
            >
                <ScrollView contentContainerStyle={styles.content} showsVerticalScrollIndicator={false}>
                    <View style={styles.iconContainer}>
                        <Ionicons name="lock-open-outline" size={80} color={colors.darkBlue} />
                    </View>
                    
                    <Text style={styles.mainTitle}>Forgot your password?</Text>
                    <Text style={styles.description}>
                        Enter your registered email address below and we'll send you a link to reset your password.
                    </Text>

                    <Text style={styles.label}>Email Address</Text>
                    <View style={styles.inputGroup}>
                            <Ionicons name="mail-outline" size={20} color={colors.darkBlue} style={styles.icon} />
                            <TextInput
                                style={styles.textInput}
                                placeholder="example@email.com"
                                keyboardType="email-address"
                                autoCapitalize="none"
                                value={email}
                                onChangeText={setEmail}
                            />
                        </View>

                    <TouchableOpacity
                        style={[styles.actionButton, isLoading && styles.buttonDisabled]}
                        onPress={handleResetPassword}
                        disabled={isLoading}
                    >

                        {isLoading ? (
                            <ActivityIndicator color={colors.white} />
                        ) : (
                            <Text style={styles.resetButtonText}>Send Reset Link</Text>
                        )}
                    </TouchableOpacity>
                </ScrollView>
            </KeyboardAvoidingView>
        </SafeAreaView>
    );
};

const styles = StyleSheet.create({ 
    container: {
        flex: 1,
        backgroundColor: colors.bgGray,
    },
    topHeader: {
        backgroundColor: colors.darkBlue,
        paddingVertical: 15,
        flexDirection: 'row',
        alignItems: 'center',
        paddingHorizontal: 20,
        borderBottomLeftRadius: 35,
        borderBottomRightRadius: 35,
        elevation: 10,
        shadowColor: colors.darkBlue,
        shadowOffset: { width: 0, height: 5 },
        shadowOpacity: 0.3,
        shadowRadius: 10,
    },
    backButton: {
        padding: 5,
    },
    topHeaderTitle: {
        color: colors.white,
        fontSize: 22,
        fontWeight: '900',
        letterSpacing: 1,
        flex: 1,
        textAlign: 'center',
    },
    screenHeader: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between',
        paddingHorizontal: 25,
        paddingTop: 20,
        paddingBottom: 10,
        backgroundColor: colors.bgGray, // Assuming the screen title is on the main background
    },
    screenTitle: {
        fontSize: 24,
        fontWeight: 'bold',
        color: colors.darkBlue,
        textAlign: 'center',
        flex: 1, // Allows title to take available space
    },
    headerAccent: {
        width: 40,
        height: 4,
        backgroundColor: colors.gold,
        marginTop: 12,
        borderRadius: 2,
        alignSelf: 'center', // Center the accent under the title
    },
    content: {
        padding: 25,
        alignItems: 'center',
    },
    iconContainer: {
        width: 100, // Slightly smaller icon container
        height: 100,
        borderRadius: 50,
        backgroundColor: colors.white,
        justifyContent: 'center',
        alignItems: 'center',
        marginBottom: 20,
        marginTop: 10,
        elevation: 5,
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 3 },
        shadowOpacity: 0.15,
        shadowRadius: 8,
    },
    mainTitle: { // Renamed from 'title' to avoid conflict and clarify purpose
        fontSize: 24,
        fontWeight: '800',
        color: colors.darkBlue,
        marginBottom: 10,
        textAlign: 'center',
    },
    description: {
        fontSize: 15,
        color: colors.lightText,
        textAlign: 'center',
        marginBottom: 30,
        lineHeight: 22,
        paddingHorizontal: 10,
    },
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
        marginBottom: 25,
        height: 56,
    },
    textInput: {
        flex: 1,
        marginLeft: 10,
        fontSize: 16, 
        color: colors.text, 
    },
    actionButton: { // Renamed from 'resetButton' for consistency with Login's 'loginButton'
        backgroundColor: colors.darkBlue, // Changed to darkBlue for consistency
        height: 56,
        borderRadius: 12, // Consistent with Login button
        justifyContent: 'center',
        alignItems: 'center',
        width: '100%',
        shadowColor: colors.darkBlue,
        shadowOffset: { width: 0, height: 4 },
        shadowOpacity: 0.2,
        shadowRadius: 8,
        elevation: 3,
    },
    resetButtonText: { // Kept name as it's specific to this button's text
        color: colors.white,
        fontSize: 17,
        fontWeight: 'bold',
    },
    buttonDisabled: {
        backgroundColor: '#CCC', // Lighter gray for disabled state
        shadowOpacity: 0,
        elevation: 0,
    },
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

export default ForgotPassword;
