import React, { useState } from 'react';
import { View, Text, StyleSheet, SafeAreaView, ScrollView, TouchableOpacity, StatusBar, FlatList } from 'react-native';
import { useRouter } from 'expo-router';
import { Ionicons } from '@expo/vector-icons';

/**
 * TimetableScreen: Displays the student's weekly class schedule.
 */
function TimetableScreen() {
  const [selectedDay, setSelectedDay] = useState('Mon');
  const router = useRouter();

  const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

  // Mock data for the timetable
  const scheduleData = {
    Mon: [
      { id: '1', code: 'CSC 401', name: 'Software Engineering II', time: '08:00 AM - 10:00 AM', room: 'Hall A1', color: '#0056b3' },
      { id: '2', code: 'CSC 405', name: 'Artificial Intelligence', time: '10:00 AM - 12:00 PM', room: 'Lab 2', color: '#28A745' },
      { id: '3', code: 'GST 411', name: 'Entrepreneurship', time: '02:00 PM - 04:00 PM', room: 'Main Theater', color: '#FFC107' },
    ],
    Tue: [
      { id: '4', code: 'CSC 403', name: 'Compiler Construction', time: '09:00 AM - 11:00 AM', room: 'Hall B2', color: '#E83E8C' },
      { id: '5', code: 'CSC 409', name: 'Network Security', time: '12:00 PM - 02:00 PM', room: 'Hall A1', color: '#17A2B8' },
    ],
    // ... add more days as needed
  };

  const renderClassItem = ({ item }) => (
    <View style={styles.classCard}>
      <View style={[styles.colorIndicator, { backgroundColor: item.color || '#0056b3' }]} />
      <View style={styles.classDetails}>
        <View style={styles.classHeader}>
          <Text style={styles.classCode}>{item.code}</Text>
          <Text style={styles.classTime}>{item.time}</Text>
        </View>
        <Text style={styles.className}>{item.name}</Text>
        <View style={styles.locationBadge}>
          <Text style={styles.locationText}>{item.room}</Text>
        </View>
      </View>
    </View>
  );

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="light-content" backgroundColor="#1A2B4C" />
      <View style={styles.header}>
        <View style={styles.headerMain}>
          <TouchableOpacity onPress={() => router.back()} style={styles.backButton}>
            <Ionicons name="arrow-back" size={26} color="#FFFFFF" />
          </TouchableOpacity>
          <Text style={styles.headerTitle}>Timetable</Text>
        </View>
      </View>

      {/* Day Selector */}
      <View style={styles.daySelectorContainer}>
        <ScrollView horizontal showsHorizontalScrollIndicator={false} contentContainerStyle={styles.daySelector}>
          {days.map((day) => (
            <TouchableOpacity
              key={day}
              style={[styles.dayButton, selectedDay === day && styles.dayButtonActive]}
              onPress={() => setSelectedDay(day)}
            >
              <Text style={[styles.dayButtonText, selectedDay === day && styles.dayButtonTextActive]}>
                {day}
              </Text>
            </TouchableOpacity>
          ))}
        </ScrollView>
      </View>

      {/* Schedule List */}
      <FlatList
        data={scheduleData[selectedDay] || []}
        keyExtractor={(item) => item.id}
        renderItem={renderClassItem}
        contentContainerStyle={styles.listContent}
        ListEmptyComponent={
          <View style={styles.emptyContainer}>
            <Text style={styles.emptyText}>No classes scheduled for this day.</Text>
          </View>
        }
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
    backgroundColor: '#1A2B4C',
    paddingHorizontal: 25,
    paddingTop: 40,
    paddingBottom: 25,
    elevation: 5,
  },
  headerMain: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
    marginBottom: 0,
  },
  backButton: {
    marginRight: 12,
    marginLeft: -5,
  },
  headerTitle: {
    fontSize: 28,
    fontWeight: '900',
    color: '#FFFFFF',
  },
  headerSubtitle: {
    fontSize: 14,
    color: '#A7BCCF',
    marginTop: 4,
    textAlign: 'right',
  },
  daySelectorContainer: {
    marginVertical: 10,
  },
  daySelector: {
    paddingHorizontal: 20,
    paddingBottom: 10,
  },
  dayButton: {
    paddingHorizontal: 20,
    paddingVertical: 10,
    borderRadius: 12,
    marginRight: 10,
    backgroundColor: '#FFFFFF',
    borderWidth: 1,
    borderColor: '#EEEEEE',
  },
  dayButtonActive: {
    backgroundColor: '#0056b3',
    borderColor: '#0056b3',
    elevation: 4,
    shadowColor: '#0056b3',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.3,
    shadowRadius: 4,
  },
  dayButtonText: {
    fontSize: 14,
    fontWeight: '600',
    color: '#666',
  },
  dayButtonTextActive: {
    color: '#FFFFFF',
  },
  listContent: {
    paddingHorizontal: 20,
    paddingBottom: 30,
  },
  classCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 16,
    marginBottom: 15,
    flexDirection: 'row',
    overflow: 'hidden',
    elevation: 3,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.05,
    shadowRadius: 8,
  },
  colorIndicator: {
    width: 6,
    height: '100%',
  },
  classDetails: {
    flex: 1,
    padding: 16,
  },
  classHeader: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: 6,
  },
  classCode: {
    fontSize: 12,
    fontWeight: '800',
    color: '#0056b3',
    letterSpacing: 0.5,
  },
  classTime: {
    fontSize: 12,
    color: '#999',
    fontWeight: '500',
  },
  className: {
    fontSize: 17,
    fontWeight: '700',
    color: '#1A1A1A',
    marginBottom: 10,
  },
  locationBadge: {
    backgroundColor: '#F1F3F5',
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 6,
    alignSelf: 'flex-start',
  },
  locationText: {
    fontSize: 11,
    fontWeight: '600',
    color: '#495057',
  },
  emptyContainer: {
    alignItems: 'center',
    marginTop: 100,
  },
  emptyText: {
    color: '#999',
    fontSize: 14,
  },
});

export default TimetableScreen;