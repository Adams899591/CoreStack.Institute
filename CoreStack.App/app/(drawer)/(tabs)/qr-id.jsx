import React from 'react';
import { View, Text, StyleSheet, SafeAreaView, Dimensions, StatusBar } from 'react-native';
// Make sure to install: npm install react-native-qrcode-svg react-native-svg
import QRCode from 'react-native-qrcode-svg';

const { width } = Dimensions.get('window');

/**
 * QRIdScreen: Displays the student's unique digital identification.
 */
function QRIdScreen() {
  // ===========================================================================
  // DATA TO BE HIDDEN IN THE QR CODE
  // ===========================================================================
  // This 'qrValue' is the most important part. Whatever string you put here 
  // will be encoded into the QR code. When a scanner (like a lecturer's phone) 
  // reads this code, this is the data they will see.
  // Usually, you would pass the Student's unique database ID here.
  const qrValue = "STUDENT_ID_CS_2024_001"; 
  // ===========================================================================

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="dark-content" />
      <View style={styles.content}>
        <Text style={styles.headerTitle}>Digital ID</Text>
        <Text style={styles.description}>
          Present this QR code to the scanner for verification or attendance marking.
        </Text>

        {/* This is the visible QR Code Card */}
        <View style={styles.qrCard}>
          <View style={styles.qrWrapper}>
            <QRCode
              value={qrValue} // Passing the "hidden" data here
              size={width * 0.6}
              color="#1A1A1A"
              backgroundColor="#FFFFFF"
            />
          </View>
          
          <View style={styles.studentDetails}>
            <Text style={styles.studentName}>John Doe</Text>
            <Text style={styles.studentMatric}>CSC/2024/001</Text>
          </View>
        </View>

        <View style={styles.footerInfo}>
          <Text style={styles.footerText}>CoreStack Institute • 2024 Session</Text>
        </View>
      </View>
    </SafeAreaView>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#F8F9FA',
  },
  content: {
    flex: 1,
    alignItems: 'center',
    paddingTop: 60,
    paddingHorizontal: 25,
  },
  headerTitle: {
    fontSize: 28,
    fontWeight: '900',
    color: '#1A1A1A',
    marginBottom: 10,
  },
  description: {
    fontSize: 14,
    color: '#666',
    textAlign: 'center',
    marginBottom: 40,
    lineHeight: 20,
  },
  qrCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    padding: 25,
    alignItems: 'center',
    width: '100%',
    elevation: 8,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 4 },
    shadowOpacity: 0.1,
    shadowRadius: 12,
  },
  qrWrapper: {
    padding: 10,
    borderWidth: 1,
    borderColor: '#EEEEEE',
    borderRadius: 12,
    marginBottom: 20,
  },
  studentDetails: {
    alignItems: 'center',
  },
  studentName: {
    fontSize: 20,
    fontWeight: '700',
    color: '#333',
  },
  studentMatric: {
    fontSize: 14,
    color: '#0056b3',
    fontWeight: '600',
    marginTop: 4,
  },
  footerInfo: {
    marginTop: 'auto',
    marginBottom: 30,
  },
  footerText: {
    fontSize: 12,
    color: '#999',
    fontWeight: '500',
  },
});

export default QRIdScreen;