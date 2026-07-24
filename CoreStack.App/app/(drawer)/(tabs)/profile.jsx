import React, { useContext } from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity, StatusBar } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
// import { UserContext } from '@/app/context/UserContext';
import { UserContext } from '@/context/UserContext';

const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  bgGray: '#f8f9fa',
  white: '#ffffff',
  gray: '#666',
  lightGray: '#eee',
  danger: '#dc3545'
};

const ProfileItem = ({ icon, label, value, color = colors.darkBlue }) => (
  <View style={styles.infoItem}>
    <View style={[styles.iconContainer, { backgroundColor: color + '15' }]}>
      <Ionicons name={icon} size={20} color={color} />
    </View>
    <View style={styles.textContainer}>
      <Text style={styles.infoLabel}>{label}</Text>
      <Text style={styles.infoValue}>{value}</Text>
    </View>
  </View>
);

export default function ProfileScreen() {

  const { user, setUser } = useContext(UserContext);

  // Mock student data consistent with the Home screen
  const student = {
    name: user.user.name,
    matric: user.matric_number,
    department: user.department.name,
    level: `${user.level} Level`,
    email: user.user.email,
    phone: user.phone,
    cgpa: user.current_gpa,
    admissionYear: user.admission_year,
    dob: user.date_of_birth,
    gender: user.gender,
    nationality: user.nationality,
    stateOfOrigin: user.state_of_origin,
    maritalStatus: user.marital_status
  };

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="light-content" backgroundColor="#1A2B4C" />
      <ScrollView showsVerticalScrollIndicator={false}>
        {/* Content Section */}
        <View style={styles.content}>
          
          {/* Personal Biography Card */}
          <View style={styles.card}>
            <Text style={styles.cardTitle}>Personal Biography</Text>
            <ProfileItem icon="person-outline" label="Legal Name" value={student.name} />
            <ProfileItem icon="calendar-outline" label="Date of Birth" value={student.dob} />
            <ProfileItem icon="male-female-outline" label="Gender" value={student.gender} />
            <ProfileItem icon="flag-outline" label="Nationality" value={student.nationality} />
            <ProfileItem icon="location-outline" label="State of Origin" value={student.stateOfOrigin} />
            <ProfileItem icon="heart-outline" label="Marital Status" value={student.maritalStatus} />
          </View>

          {/* Academic Info Card */}
          <View style={styles.card}>
            <Text style={styles.cardTitle}>Academic Information</Text>
            <ProfileItem icon="school-outline" label="Department" value={student.department} />
            <ProfileItem icon="layers-outline" label="Level" value={student.level} />
            <ProfileItem icon="trophy-outline" label="Current CGPA" value={student.cgpa} color={colors.gold} />
            <ProfileItem icon="calendar-outline" label="Admission Year" value={student.admissionYear} />
          </View>

          {/* Personal Info Card */}
          <View style={styles.card}>
            <Text style={styles.cardTitle}>Contact Details</Text>
            <ProfileItem icon="mail-outline" label="Email Address" value={student.email} />
            <ProfileItem icon="call-outline" label="Phone Number" value={student.phone} />
          </View>

          <Text style={styles.versionText}>CoreStack App v1.0.0</Text>
        </View>
      </ScrollView>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: colors.bgGray },
  header: {
    backgroundColor: colors.darkBlue,
    paddingTop: 40,
    paddingBottom: 30,
    borderBottomLeftRadius: 30,
    borderBottomRightRadius: 30,
    alignItems: 'center',
  },
  headerContent: { alignItems: 'center' },
  avatarContainer: { position: 'relative', marginBottom: 15 },
  avatar: {
    width: 100,
    height: 100,
    borderRadius: 50,
    backgroundColor: 'rgba(255,255,255,0.2)',
    justifyContent: 'center',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: 'rgba(255,255,255,0.5)',
  },
  editAvatarBtn: {
    position: 'absolute',
    bottom: 0,
    right: 0,
    backgroundColor: colors.gold,
    width: 32,
    height: 32,
    borderRadius: 16,
    justifyContent: 'center',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: colors.darkBlue,
  },
  userName: { color: colors.white, fontSize: 22, fontWeight: 'bold' },
  userMatric: { color: colors.lightText, fontSize: 14, marginTop: 4 },
  content: { padding: 20 },
  card: {
    backgroundColor: colors.white,
    borderRadius: 15,
    padding: 20,
    marginBottom: 20,
    elevation: 2,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.05,
    shadowRadius: 5,
  },
  cardTitle: { fontSize: 16, fontWeight: 'bold', color: colors.darkBlue, marginBottom: 15 },
  infoItem: { flexDirection: 'row', alignItems: 'center', marginBottom: 15 },
  iconContainer: { width: 40, height: 40, borderRadius: 20, justifyContent: 'center', alignItems: 'center', marginRight: 15 },
  textContainer: { flex: 1 },
  infoLabel: { fontSize: 12, color: '#999', marginBottom: 2 },
  infoValue: { fontSize: 15, color: '#333', fontWeight: '500' },
  actionBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    paddingVertical: 12,
    borderBottomWidth: 1,
    borderBottomColor: '#f0f0f0',
  },
  actionLeft: { flexDirection: 'row', alignItems: 'center' },
  actionText: { fontSize: 15, color: '#444', marginLeft: 15 },
  logoutBtn: { borderBottomWidth: 0, marginTop: 5 },
  versionText: { textAlign: 'center', color: '#ccc', fontSize: 12, marginBottom: 20 },
});