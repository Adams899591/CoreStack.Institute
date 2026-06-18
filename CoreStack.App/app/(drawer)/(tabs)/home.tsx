import React, { useState } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, SafeAreaView } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { StatusBar } from 'expo-status-bar';

// Brand Colors moved outside the component so styles can access them
const colors = {
  darkBlue: '#1A2B4C',
  gold: '#D4AF37',
  lightText: '#A7BCCF',
  bgGray: '#f8f9fa'
};

export default function HomeScreen() {
  const [isIdVisible, setIsIdVisible] = useState(false);

  // Mock student data
  const studentName = "Dev John Doe";
  const matricNumber = "CS-2024-0882";
  const department = "Web Cybersecurity";
  const studentLevel = "300L";
  const gpa = "4.85";

  const easyLinks = [
    { name: 'Attendance', icon: 'calendar-outline' },
    { name: 'Timetable', icon: 'time-outline' },
    { name: 'Exams', icon: 'document-text-outline' },
    { name: 'Results', icon: 'trophy-outline' },
    { name: 'Library', icon: 'library-outline' },
    { name: 'Fees', icon: 'card-outline' },
    { name: 'Resources', icon: 'cloud-download-outline' },
    { name: 'Support', icon: 'help-circle-outline' },
  ];

  return (
    <>
    <StatusBar barStyle="light-content" backgroundColor="#1A2B4C" /> 
      <SafeAreaView style={styles.container}> 
        <ScrollView showsVerticalScrollIndicator={false}>
          <View style={[styles.card, styles.studentInfoCard]}>
            <View style={styles.infoRow}>
              <View style={styles.welcomeContainer}>
                <Text style={styles.welcomeText}>Welcome back,</Text>
                <Text style={styles.studentName}>{studentName}</Text>
              </View>
              <View style={styles.levelBadge}>
                <Text style={styles.levelText}>{studentLevel}</Text>
              </View>
            </View>

            <View style={styles.detailRow}>
              <View style={styles.idContainer}>
                <Text style={styles.idLabel}>Matric Number</Text>
                <View style={styles.idRow}>
                  <Text style={styles.idText}>
                    {isIdVisible ? matricNumber : '•••• •••• ••••'}
                  </Text>
                  <TouchableOpacity onPress={() => setIsIdVisible(!isIdVisible)}>
                    <Ionicons
                      name={isIdVisible ? "eye-off-outline" : "eye-outline"}
                      size={16} 
                      color={colors.darkBlue} 
                      style={{ marginLeft: 5 }}
                    />
                  </TouchableOpacity>
                </View>
              </View>
              <View style={styles.departmentContainer}>
                <Text style={styles.idLabel}>Department</Text>
                <Text style={styles.departmentText}>{department}</Text>
              </View>
            </View>
          </View>
          <View style={[styles.card, styles.academicStatsCard]}>
            <View style={styles.sectionHeader}>
              <Text style={styles.sectionTitleSmall}>Current CGPA</Text>
              <TouchableOpacity>
                <Text style={styles.viewAllText}>View Academic Progress</Text>
              </TouchableOpacity>
            </View>
            <Text style={styles.gpaAmount}>{gpa}</Text>
          </View>
          <View style={styles.sectionContainer}>
            <Text style={styles.sectionTitle}>Easy Links</Text>
            <View style={styles.linksGrid}>
              {easyLinks.map((link, index) => (
                <TouchableOpacity key={index} style={styles.linkItem}>
                  <View style={styles.iconSquare}>
                    <Ionicons name={link.icon as any} size={24} color={colors.darkBlue} />
                  </View>
                  <Text style={styles.linkText}>{link.name}</Text>
                </TouchableOpacity>
              ))}
            </View>
          </View>
        </ScrollView>
      </SafeAreaView>
    </>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#f8f9fa' },
  card: {
    backgroundColor: '#ffffff', 
    marginHorizontal: 20, 
    marginTop: 20, 
    borderRadius: 15, 
    padding: 20, 
    elevation: 4, 
    shadowColor: '#000', 
    shadowOffset: { width: 0, height: 2 }, 
    shadowOpacity: 0.1, 
    shadowRadius: 8 
  },
  studentInfoCard: {
    marginBottom: 10, // Spacing between the two new cards
  },
  academicStatsCard: {
    // No specific styles needed here other than the generic 'card' styles for now
  },
  infoRow: { 
    flexDirection: 'row', 
    justifyContent: 'space-between', 
    alignItems: 'center', 
    marginBottom: 15 
  },
  welcomeContainer: {},
  welcomeText: { color: '#666', fontSize: 14, marginBottom: 2 },
  studentName: { color: colors.darkBlue, fontSize: 20, fontWeight: 'bold' },
  levelBadge: { backgroundColor: '#1A2B4C20', paddingHorizontal: 10, paddingVertical: 4, borderRadius: 6 },
  levelText: { color: colors.darkBlue, fontWeight: 'bold', fontSize: 12 },
  detailRow: { flexDirection: 'row', justifyContent: 'space-between', marginBottom: 15 },
  idContainer: {},
  idLabel: { color: '#999', fontSize: 12, marginBottom: 2 },
  idRow: { flexDirection: 'row', alignItems: 'center' },
  idText: { color: colors.darkBlue, fontWeight: 'bold', fontSize: 16 },
  departmentContainer: { alignItems: 'flex-end' },
  departmentText: { color: colors.darkBlue, fontWeight: 'bold', fontSize: 16 },
  gpaAmount: { color: colors.gold, fontSize: 36, fontWeight: 'bold', textAlign: 'center', marginTop: 10 },
  sectionContainer: { marginTop: 25, paddingHorizontal: 20 },
  sectionHeader: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 15 },
  sectionTitle: { fontSize: 18, fontWeight: 'bold', color: '#1A2B4C' },
  sectionTitleSmall: { fontSize: 16, fontWeight: 'bold', color: '#1A2B4C' },
  viewAllText: { color: '#D4AF37', fontSize: 14, fontWeight: 'bold' },
  linksGrid: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
  linkItem: { width: '23%', alignItems: 'center', marginBottom: 20 },
  iconSquare: { width: 50, height: 50, borderRadius: 8, backgroundColor: '#ffffff', justifyContent: 'center', alignItems: 'center', elevation: 2, shadowColor: '#000', shadowOffset: { width: 0, height: 1 }, shadowOpacity: 0.1, shadowRadius: 2, marginBottom: 8 },
  linkText: { fontSize: 11, color: '#555', textAlign: 'center' },
});
