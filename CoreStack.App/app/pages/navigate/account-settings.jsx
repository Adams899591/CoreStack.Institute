import React, { useState, useRef, useEffect } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity, StatusBar, TextInput, ScrollView, Switch, ActivityIndicator, Alert, KeyboardAvoidingView, Platform, Animated, Modal, Pressable } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';
import * as LocalAuthentication from 'expo-local-authentication';
import * as Haptics from 'expo-haptics';

const colors = {
    primary: '#1A2B4C',
    gold: '#D4AF37',
    black: '#000000',
    background: '#F8F9FA',
    white: '#FFFFFF',
    text: '#1A1A1A',
    muted: '#999',
    border: '#E0E0E0',
    lightBlue: '#E8EDF2',
    // Added for modal styles
    darkGray: '#333',
    gray: '#666',
    lightGray: '#F1F3F5',
};

const AccountSettings = () => {
    const router = useRouter();
    const [matricNumber] = useState('CS-2024-0882');
    const [newPassword, setNewPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [showPass, setShowPass] = useState(false);
    const [showConfirmPass, setShowConfirmPass] = useState(false);
    const [isFingerprintEnabled, setIsFingerprintEnabled] = useState(false);
    const [isLoading, setIsLoading] = useState(false);

    // New state variables for biometric authentication
    const [modalVisible, setModalVisible] = useState(false); // To control the biometric modal visibility
    const [isHolding, setIsHolding] = useState(false);
    const [isAuthenticating, setIsAuthenticating] = useState(false);
    const [holdProgress, setHoldProgress] = useState(0);
    const scanningLineAnim = useRef(new Animated.Value(0)).current; // For scanning line animation
    const timerRef = useRef(null); // Ref to store the 5-second timer
    const progressIntervalRef = useRef(null); // Ref to update the progress indicator

    // function to start the scanning animation (a line moving up and down over the fingerprint icon)
    const startScanningAnimation = () => {
        scanningLineAnim.setValue(0); // Reset animation
        Animated.loop(
            Animated.sequence([
                Animated.timing(scanningLineAnim, {
                    toValue: 1,
                    duration: 1500,
                    useNativeDriver: true,
                }),
                Animated.timing(scanningLineAnim, {
                    toValue: 0,
                    duration: 1500,
                    useNativeDriver: true,
                }),
            ])
        ).start();
    };

    // function to stop the scanning animation and reset the position of the scanning line
    const stopScanningAnimation = () => {
        scanningLineAnim.stopAnimation();
        scanningLineAnim.setValue(0); // Reset position
    };

    // function to clean up timers and intervals to prevent memory leaks and unintended behavior when the user cancels authentication or when the component unmounts
    const cleanupTimer = () => {
        if (timerRef.current) {
            clearTimeout(timerRef.current);
            timerRef.current = null;
        }
        if (progressIntervalRef.current) {
            clearInterval(progressIntervalRef.current);
            progressIntervalRef.current = null;
        }
    };

    // useEffect to clean up timers and stop animations when the modal is closed, ensuring that if the user cancels the process or if the component unmounts, there are no lingering timers or animations running in the background
    useEffect(() => {
        if (!modalVisible) {
            stopScanningAnimation();
            cleanupTimer();
            setIsHolding(false);
        } else {
            // Start animation when modal becomes visible
            startScanningAnimation();
        }
        return cleanupTimer;
    }, [modalVisible]);

    //
    const translateY = scanningLineAnim.interpolate({
        inputRange: [0, 1],
        outputRange: [-45, 45], // Widened range to cover the 80px icon
    });

    // function to start the hold progress, which will update the holdProgress state every 50ms to create a visual progress indicator for the user as they hold the fingerprint icon, giving them feedback on how long they need to hold before authentication is triggered
    const startHoldProgress = () => {
        const duration = 5000;
        const intervalDuration = 50;
        let elapsed = 0;
        setHoldProgress(0);
        progressIntervalRef.current = setInterval(() => {
            elapsed += intervalDuration;
            setHoldProgress(Math.min(elapsed / duration, 1));
        }, intervalDuration);
    };

    // Function to generate a 16-character random string (The "Crystal")
    const generateBiometricToken = () => {
        const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        let result = "";
        for (let i = 0; i < 16; i++) {
            result += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return result;
    };

    const handleSave = () => {
        if (newPassword && newPassword !== confirmPassword) {
            Alert.alert("Error", "Passwords do not match.");
            return;
        }
        setIsLoading(true);
        setTimeout(() => {
            setIsLoading(false);
            Alert.alert("Success", "Account settings updated successfully!");
            setNewPassword('');
            setConfirmPassword('');
        }, 1500);
    };

    // function to handle press in and out for the fingerprint icon (for visual feedback and hold-to-authenticate)
    function handlePressIn() {
        if (isAuthenticating) return;
        Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
        setIsHolding(true);
        startScanningAnimation(); // Ensure animation restarts on new press-in
        cleanupTimer();
        startHoldProgress();
        timerRef.current = setTimeout(() => {
            handleBiometricAuthentication();
        }, 5000);
    }

    // function to handle press out, which will reset the hold state and stop the scanning animation if the user releases the icon before the 5-second threshold, ensuring that the authentication process is only triggered if they hold for the full duration
    function handlePressOut() {
        if (isAuthenticating) return;
        cleanupTimer();
        setIsHolding(false);
        setHoldProgress(0);
        stopScanningAnimation();
    }

    // function to handle the biometric authentication process when the user successfully holds the fingerprint icon for 5 seconds, which will attempt to authenticate and provide feedback based on the result
    const handleBiometricAuthentication = async () => {
        cleanupTimer();
        setIsAuthenticating(true);
        setHoldProgress(1);
        try {
            // this call the main finger print from the user ios
            const result = await LocalAuthentication.authenticateAsync({
                promptMessage: 'Authenticate to enable Fingerprint Login',
                cancelLabel: 'Cancel',
            });

            if (result.success) {
                //  ================ this part handles submission to laravel ==================
                // User explicitly asked to ignore Laravel part for now.
                // const newToken = generateBiometricToken();  // function that generate token

                // // 1. Save the biometric token to  SecureStore
                // await SecureStore.setItemAsync("biometric_token", newToken);

                // // 2. Save the token locally on the device
                // await AsyncStorage.setItem("biometric_token", newToken);

                // // 3. Send the token to Laravel to link it with this user
                // await axios.post(`${API_URL}/auth/enable-biometric/${user.id}`, {
                //   biometric_token: newToken,
                // });

                // =============================
                Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
                setIsFingerprintEnabled(true);
                Alert.alert("Success", "Fingerprint authentication enabled!");
            } else if (result.error === 'user_cancel') {
                Alert.alert("Cancelled", "Fingerprint authentication cancelled.");
                setIsFingerprintEnabled(false); // Ensure switch is off if cancelled
            } else {
                Alert.alert("Authentication Failed", "Could not authenticate with fingerprint. Please try again.");
                setIsFingerprintEnabled(false); // Ensure switch is off if failed
            }
        } catch (error) {
            console.error("Biometric authentication error:", error);
            Alert.alert("Error", "An error occurred during biometric authentication.");
            setIsFingerprintEnabled(false); // Ensure switch is off if error
        } finally {
            setIsAuthenticating(false);
            setIsHolding(false);
            setModalVisible(false);
            stopScanningAnimation();
        }
    };

    const onToggleFingerprint = (value) => {
        if (value) {
            setIsFingerprintEnabled(false); // Keep off until authentication succeeds
            setModalVisible(true);
        } else {
            setIsFingerprintEnabled(false);
            Alert.alert("Disabled", "Fingerprint authentication has been disabled.");
        }
    };

    return(
        <SafeAreaView style={styles.container}>
            <StatusBar barStyle="light-content" backgroundColor={colors.primary} />
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
                <View style={styles.settingItem}>
                    <View style={styles.settingLabelGroup}>
                        <Ionicons name="finger-print" size={24} color={colors.black} />
                        <Text style={styles.settingLabel}>Enable Biometric Login</Text>
                    </View>
                    <Switch
                        trackColor={{ false: "#DDD", true: colors.primary }}
                        thumbColor={isFingerprintEnabled ? colors.black : "#FFF"}
                        onValueChange={onToggleFingerprint}
                        value={isFingerprintEnabled}
                    />
                </View>

                <TouchableOpacity
                    style={[styles.saveButton, isLoading && styles.saveButtonDisabled]}
                    onPress={handleSave}
                    disabled={isLoading}
                >
                    {isLoading ? (
                        <ActivityIndicator color={colors.white} />
                    ) : (
                        <Text style={styles.saveButtonText}>Update Account</Text>
                    )}
                </TouchableOpacity>
                <View style={{ height: 40 }} />
            </ScrollView>

            <Modal
                transparent
                visible={modalVisible}
                animationType="fade"
                onRequestClose={() => {
                    cleanupTimer();
                    setModalVisible(false);
                    setIsFingerprintEnabled(false);
                }}
            >
                <View style={styles.modalOverlay}>
                    <View style={styles.modalContent}>
                        <Text style={styles.modalTitle}>Enable Biometric Login</Text>
                        <Text style={styles.modalText}>
                            Hold the fingerprint icon for 5 seconds to authenticate and enable biometric login.
                        </Text>

                        <Pressable
                            onPressIn={handlePressIn}
                            onPressOut={handlePressOut}
                            style={styles.fingerprintButton}
                        >
                            <Ionicons name="finger-print" size={48} color={colors.primary} />
                            <Animated.View
                                style={[
                                    styles.scanningLine,
                                    { transform: [{ translateY }] },
                                ]}
                            />
                        </Pressable>

                        <View style={styles.progressBar}>
                            <View style={[styles.progressFill, { width: `${holdProgress * 100}%` }]} />
                        </View>

                        {isAuthenticating ? (
                            <ActivityIndicator size="small" color={colors.primary} />
                        ) : (
                            <Text style={styles.modalHint}>
                                {isHolding ? 'Keep holding...' : 'Tap and hold to start'}
                            </Text>
                        )}

                        <TouchableOpacity
                            style={styles.modalCloseButton}
                            onPress={() => {
                                cleanupTimer();
                                setModalVisible(false);
                                setIsFingerprintEnabled(false);
                            }}
                        >
                            <Text style={styles.modalCloseButtonText}>Cancel</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>
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
    settingItem: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        backgroundColor: colors.white,
        borderRadius: 16,
        padding: 20,
        marginBottom: 25,
        elevation: 2,
    },
    settingLabelGroup: {
        flexDirection: 'row',
        alignItems: 'center',
    },
    settingLabel: {
        fontSize: 16,
        fontWeight: '600',
        color: colors.text,
        marginLeft: 12,
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
    modalOverlay: {
        flex: 1,
        backgroundColor: 'rgba(0,0,0,0.45)',
        justifyContent: 'center',
        alignItems: 'center',
        padding: 20,
    },
    modalContent: {
        width: '100%',
        backgroundColor: colors.white,
        borderRadius: 24,
        padding: 24,
        alignItems: 'center',
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 8 },
        shadowOpacity: 0.15,
        shadowRadius: 20,
        elevation: 10,
    },
    modalTitle: {
        fontSize: 20,
        fontWeight: '800',
        color: colors.primary,
        marginBottom: 12,
        textAlign: 'center',
    },
    modalText: {
        fontSize: 14,
        color: colors.muted,
        textAlign: 'center',
        marginBottom: 18,
    },
    fingerprintButton: {
        width: 120,
        height: 120,
        borderRadius: 60,
        borderWidth: 2,
        borderColor: colors.primary,
        justifyContent: 'center',
        alignItems: 'center',
        marginBottom: 18,
        overflow: 'hidden',
        backgroundColor: colors.lightGray,
    },
    scanningLine: {
        position: 'absolute',
        left: 0,
        right: 0,
        height: 2,
        backgroundColor: colors.primary,
        opacity: 0.7,
    },
    progressBar: {
        width: '100%',
        height: 8,
        borderRadius: 6,
        backgroundColor: '#E8EDF2',
        overflow: 'hidden',
        marginBottom: 12,
    },
    progressFill: {
        height: '100%',
        backgroundColor: colors.primary,
    },
    modalHint: {
        fontSize: 13,
        color: colors.text,
        marginBottom: 18,
    },
    modalCloseButton: {
        paddingVertical: 12,
        paddingHorizontal: 22,
        backgroundColor: colors.primary,
        borderRadius: 12,
    },
    modalCloseButtonText: {
        color: colors.white,
        fontWeight: '700',
        fontSize: 14,
    },
});

export default AccountSettings;
