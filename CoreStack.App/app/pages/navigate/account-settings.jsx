import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, TouchableOpacity, StatusBar, TextInput, ScrollView, Switch, ActivityIndicator, Alert, KeyboardAvoidingView, Platform } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useRouter } from 'expo-router';

const colors = {
    primary: '#1A2B4C',
    gold: '#D4AF37',
    background: '#F8F9FA',
    white: '#FFFFFF',
    text: '#1A1A1A',
    muted: '#999',
    border: '#E0E0E0',
    lightBlue: '#E8EDF2'
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
                        <Ionicons name="finger-print" size={24} color={colors.gold} />
                        <Text style={styles.settingLabel}>Enable Biometric Login</Text>
                    </View>
                    <Switch
                        trackColor={{ false: "#DDD", true: colors.primary }}
                        thumbColor={isFingerprintEnabled ? colors.gold : "#FFF"}
                        onValueChange={setIsFingerprintEnabled}
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
        backgroundColor: colors.gold,
        height: 55,
        borderRadius: 12,
        justifyContent: 'center',
        alignItems: 'center',
        marginTop: 10,
        elevation: 4,
        shadowColor: colors.gold,
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
