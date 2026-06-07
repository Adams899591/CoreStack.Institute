import React from 'react';
import { View, Text, FlatList, StyleSheet, SafeAreaView, StatusBar } from 'react-native';

const MOCK_COURSES = [
  { id: '1', code: 'CSC 101', title: 'Introduction to Computer Science', units: 3, status: 'Ongoing' },
  { id: '2', code: 'MTH 102', title: 'Calculus and Algebra', units: 4, status: 'Ongoing' },
  { id: '3', code: 'ENG 111', title: 'Use of English I', units: 2, status: 'Completed' },
  { id: '4', code: 'PHY 101', title: 'General Physics I', units: 3, status: 'Ongoing' },
  { id: '5', code: 'GST 101', title: 'Library & Information Science', units: 1, status: 'Completed' },
];

const CourseCard = ({ course }) => (
  <View style={styles.card}>
    <View style={styles.cardHeader}>
      <Text style={styles.courseCode}>{course.code}</Text>
      <View style={[styles.badge, course.status === 'Completed' ? styles.badgeSuccess : styles.badgeInfo]}>
        <Text style={styles.badgeText}>{course.status}</Text>
      </View>
    </View>
    <Text style={styles.courseTitle}>{course.title}</Text>
    <View style={styles.cardFooter}>
      <Text style={styles.unitLabel}>Credit Units: <Text style={styles.unitValue}>{course.units}</Text></Text>
    </View>
  </View>
);

export default function CoursesScreen() {
  const totalUnits = MOCK_COURSES.reduce((sum, item) => sum + item.units, 0);

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <View style={styles.header}>
        <Text style={styles.headerTitle}>My Courses</Text>
        <View style={styles.summaryContainer}>
          <Text style={styles.summaryText}>Total Courses: {MOCK_COURSES.length}</Text>
          <Text style={styles.summaryText}>Total Units: {totalUnits}</Text>
        </View>
      </View>

      <FlatList
        data={MOCK_COURSES}
        keyExtractor={(item) => item.id}
        renderItem={({ item }) => <CourseCard course={item} />}
        contentContainerStyle={styles.listContent}
        showsVerticalScrollIndicator={false}
      />
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F8F9FA',
  },
  header: {
    padding: 20,
    backgroundColor: '#FFFFFF',
    borderBottomWidth: 1,
    borderBottomColor: '#EEEEEE',
  },
  headerTitle: {
    fontSize: 28,
    fontWeight: '800',
    color: '#1A1A1A',
    marginBottom: 8,
  },
  summaryContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  summaryText: {
    fontSize: 14,
    color: '#666',
    fontWeight: '500',
  },
  listContent: {
    padding: 16,
  },
  card: {
    backgroundColor: '#FFFFFF',
    borderRadius: 12,
    padding: 16,
    marginBottom: 16,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.05,
    shadowRadius: 8,
    elevation: 3,
  },
  cardHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 8,
  },
  courseCode: {
    fontSize: 14,
    fontWeight: 'bold',
    color: '#0056b3',
  },
  courseTitle: {
    fontSize: 18,
    fontWeight: '600',
    color: '#333',
    marginBottom: 12,
  },
  unitLabel: {
    fontSize: 14,
    color: '#777',
  },
  unitValue: {
    fontWeight: 'bold',
    color: '#333',
  },
  badge: {
    paddingHorizontal: 8,
    paddingVertical: 4,
    borderRadius: 6,
  },
  badgeSuccess: { backgroundColor: '#D4EDDA' },
  badgeInfo: { backgroundColor: '#CCE5FF' },
  badgeText: { fontSize: 10, fontWeight: 'bold', color: '#444' },
});
