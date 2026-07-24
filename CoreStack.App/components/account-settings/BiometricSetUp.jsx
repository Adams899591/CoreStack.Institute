import React, { useState, useRef, useEffect, useContext } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, ActivityIndicator, Alert, Animated, Modal, Pressable, Switch } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import * as LocalAuthentication from 'expo-local-authentication';
import * as Haptics from 'expo-haptics';
import axios from "axios";
import * as SecureStore from 'expo-secure-store';

const colors = {
    primary: '#1A2B4C',
    white: '#FFFFFF',
    text: '#1A1A1A',
    muted: '#999',
    lightGray: '#F1F3F5',
    black: '#000000',
};

const BiometricSetUp = ({user}) => {
    
    const [isFingerprintEnabled, setIsFingerprintEnabled] = useState(user.user.biometric_enabled ? true : false);
    const [modalVisible, setModalVisible] = useState(false);
    const [isHolding, setIsHolding] = useState(false);
    const [isAuthenticating, setIsAuthenticating] = useState(false);
    const [holdProgress, setHoldProgress] = useState(0);

    const scanningLineAnim = useRef(new Animated.Value(0)).current;
    const timerRef = useRef(null);
    const progressIntervalRef = useRef(null);

    // Function to handle disabled fingerprint
    const handleSwitchToggle = async (value) => {
        if (value) {
            setIsFingerprintEnabled(false);
            setModalVisible(true);
        } else {
                   //   Handle send request to laravel to disable fingerprint
                    try {
                             const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/auth/biometric-setUp/${user.user.id}`,{
                                enabled: isFingerprintEnabled,
                             });
                               
                             const res = response.data;
                             console.log(res);
                             
                             if(res.status === "success"){
                                    // 3. DELETE (Key ONLY)
                                    await SecureStore.deleteItemAsync('biometric_token');
                                 
                                    setIsFingerprintEnabled(false);
                                    Alert.alert("Disabled", "Fingerprint authentication has been disabled.");
                             }
                         
                     } catch (error) {
                         console.log(error);
                         Alert.alert("Error", "Something went wrong failed to set up Biometric Authentication");     
                     }
        }
    };

    const startScanningAnimation = () => {
        scanningLineAnim.setValue(0);
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

    const stopScanningAnimation = () => {
        scanningLineAnim.stopAnimation();
        scanningLineAnim.setValue(0);
    };

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

    useEffect(() => {
        if (!modalVisible) {
            stopScanningAnimation();
            cleanupTimer();
            setIsHolding(false);
        } else {
            startScanningAnimation();
        }
        return cleanupTimer;
    }, [modalVisible]);

    const translateY = scanningLineAnim.interpolate({
        inputRange: [0, 1],
        outputRange: [-45, 45],
    });

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

    function handlePressIn() {
        if (isAuthenticating) return;
        Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
        setIsHolding(true);
        startScanningAnimation();
        cleanupTimer();
        startHoldProgress();
        timerRef.current = setTimeout(() => {
            handleBiometricAuthentication();
        }, 5000);
    }

    function handlePressOut() {
        if (isAuthenticating) return;
        cleanupTimer();
        setIsHolding(false);
        setHoldProgress(0);
        stopScanningAnimation();
    }

    // Function to set user Biometric
    const handleBiometricAuthentication = async () => {
        cleanupTimer();
        setIsAuthenticating(true);
        setHoldProgress(1);
        try {
            const result = await LocalAuthentication.authenticateAsync({
                promptMessage: 'Authenticate to enable Fingerprint Login',
                cancelLabel: 'Cancel',
            });

            if (result.success) {
                Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
                    // Handle send request to laravel
                    try {
                             const response = await axios.post(`${process.env.EXPO_PUBLIC_API_URL}/auth/biometric-setUp/${user.user.id}`,{
                                enabled: isFingerprintEnabled,
                             });
                               
                             const res = response.data;
                             console.log(res);
                             
                             if(res.status === "success"){
                                    // Save token under key 'biometric_token'
                                    await SecureStore.setItemAsync('biometric_token', res.biometric_token);
                               
                                    setIsFingerprintEnabled(true);
                                    Alert.alert("Success", "Fingerprint authentication enabled!");
                             }
                         
                     } catch (error) {
                         console.log(error);
                         Alert.alert("Error", "Something went wrong failed to set up Biometric Authentication");     
                     }
            } else {
                setIsFingerprintEnabled(false);
                Alert.alert("Failed", "Could not authenticate with fingerprint.");
            }
        } catch (error) {
            console.error("Biometric authentication error:", error);
            setIsFingerprintEnabled(false);
            Alert.alert("Error", "An error occurred during biometric authentication.");
        } finally {
            setIsAuthenticating(false);
            setIsHolding(false);
            setModalVisible(false);
            stopScanningAnimation();
        }
    };

    return (
        <>
            <View style={styles.settingItem}>
                <View style={styles.settingLabelGroup}>
                    <Ionicons name="finger-print" size={24} color={colors.black} />
                    <Text style={styles.settingLabel}>Enable Biometric Login</Text>
                </View>
                <Switch
                    trackColor={{ false: "#DDD", true: colors.primary }}
                    thumbColor={isFingerprintEnabled ? colors.black : "#FFF"}
                    onValueChange={handleSwitchToggle}
                    value={isFingerprintEnabled}
                />
            </View>

            <Modal
                transparent
                visible={modalVisible}
                animationType="fade"
                onRequestClose={() => {
                    cleanupTimer();
                    setModalVisible(false);
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
                            }}
                        >
                            <Text style={styles.modalCloseButtonText}>Cancel</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>
        </>
    );
};

const styles = StyleSheet.create({
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

export default BiometricSetUp;