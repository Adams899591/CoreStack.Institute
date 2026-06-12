import React, { useState, useRef, useEffect, useCallback } from 'react';
import {
  StyleSheet,
  Text,
  View,
  SafeAreaView,
  TextInput,
  TouchableOpacity,
  FlatList,
  KeyboardAvoidingView,
  Platform,
  Image,
  ImageBackground,
  Modal,
  Animated,
  Vibration,
  StatusBar,
  Alert,
  Pressable,
} from 'react-native';
import * as Clipboard from 'expo-clipboard';
import { Ionicons } from '@expo/vector-icons';
import * as ImagePicker from 'expo-image-picker';
import { Audio, InterruptionModeIOS, InterruptionModeAndroid } from 'expo-av';
import { useRouter } from 'expo-router';
import Voice from '@react-native-voice/voice';
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
    darkGray: '#333',
    gray: '#666',
    lightGray: '#F1F3F5',
    danger: '#EF4444', // Kept for recording animations
};

const MOCK_MESSAGES = [
  {
    id: '1',
    text: "Hello! Welcome to CoreStack Support. How can we assist you with your studies today?",
    sender: 'support',
    timestamp: '09:00 AM',
    type: 'text',
  },
  {
    id: '2',
    text: "I'm having trouble accessing my CSC 401 materials.",
    sender: 'user',
    timestamp: '09:01 AM',
    type: 'text',
  },
];

const GroupChatScreen = () => {
  const router = useRouter();
  const [messages, setMessages] = useState(MOCK_MESSAGES);
  const [inputText, setInputText] = useState('');
  const [selectedMessageId, setSelectedMessageId] = useState(null);
  const [isMenuVisible, setIsMenuVisible] = useState(false);
  const [isJumping, setIsJumping] = useState(false);
  const [replyingToMessage, setReplyingToMessage] = useState(null);
  const [editingMessageId, setEditingMessageId] = useState(null);
  const flatListRef = useRef();

  // Audio & Recording States
  const [isRecording, setIsRecording] = useState(false);
  const isHoldingMic = useRef(false);
  const timerRef = useRef(null);
  const [recordingTime, setRecordingTime] = useState(0);
  
  // Call States
  const [isVideoCallActive, setIsVideoCallActive] = useState(false);
  const [isVoiceCallActive, setIsVoiceCallActive] = useState(false);
  const [callStatus, setCallStatus] = useState('Connecting...');
  const [callDuration, setCallDuration] = useState(0);
  const callTimerRef = useRef(null);

  // Animations
  const pulseAnim = useRef(new Animated.Value(0)).current;
  const waveAnims = useRef([new Animated.Value(0), new Animated.Value(0), new Animated.Value(0), new Animated.Value(0)]).current;

  const startWaveAnimation = useCallback(() => {
    const animations = waveAnims.map((anim, i) =>
      Animated.loop(Animated.sequence([
        Animated.timing(anim, { toValue: 1, duration: 300 + (i * 100), useNativeDriver: true }),
        Animated.timing(anim, { toValue: 0, duration: 300 + (i * 100), useNativeDriver: true })
      ]))
    );
    Animated.parallel(animations).start();
  }, [waveAnims]);

  const stopWaveAnimation = useCallback(() => {
    waveAnims.forEach(anim => anim.stopAnimation());
    waveAnims.forEach(anim => anim.setValue(0)); // Reset to initial state
  }, [waveAnims]);

  useEffect(() => {
    // Safety check: Ensure the native module is actually available
    if (!Voice || typeof Voice.onSpeechStart !== 'function') {
      console.warn("Voice module is null. Recognition will not work.");
      return;
    }

    // Initialize Speech-to-Text listeners
    // Voice.onSpeechStart is called when the speech recognition officially starts
    Voice.onSpeechResults = (e) => {
      console.log("onSpeechResults", e);
      if (e.value && e.value.length > 0) {
        // Replace the input text with the latest result from speech recognition
        setInputText(e.value[0]);
      }
    };

    Voice.onSpeechStart = (e) => {
      console.log("onSpeechStart", e);
      setIsRecording(true);
      setRecordingTime(0);
      timerRef.current = setInterval(() => setRecordingTime(prev => prev + 1), 1000);
      Animated.loop(Animated.sequence([
        Animated.timing(pulseAnim, { toValue: 1, duration: 1000, useNativeDriver: true }),
        Animated.timing(pulseAnim, { toValue: 0, duration: 1000, useNativeDriver: true }),
      ])).start();
      startWaveAnimation();
      if (Platform.OS !== 'web') Vibration.vibrate(50);
    };

    Voice.onSpeechEnd = (e) => {
      console.log("onSpeechEnd", e);
      setIsRecording(false);
      if (timerRef.current) clearInterval(timerRef.current);
      pulseAnim.stopAnimation();
      pulseAnim.setValue(0);
      stopWaveAnimation();
      Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
    };

    Voice.onSpeechError = (e) => {
      console.log("Speech Recognition Error:", e);
      setIsRecording(false); // Ensure recording state is false on error
      if (timerRef.current) clearInterval(timerRef.current);
      pulseAnim.stopAnimation();
      pulseAnim.setValue(0);
      stopWaveAnimation();
      Alert.alert("Speech Error", "Could not process speech. Please try again.");
    };

    return () => {
      if (Voice) {
        Voice.destroy().then(Voice.removeAllListeners).catch(err => console.error(err));
      }
      if (timerRef.current) clearInterval(timerRef.current);
      pulseAnim.stopAnimation();
      pulseAnim.setValue(0);
      stopWaveAnimation();
    };
  }, [pulseAnim, startWaveAnimation, stopWaveAnimation]); // Dependencies for useCallback functions

  useEffect(() => {
    (async () => {
      try {
        await Audio.requestPermissionsAsync();
        await ImagePicker.requestMediaLibraryPermissionsAsync();
        // Set audio mode once for recording, this is a good default for voice input
        await Audio.setAudioModeAsync({
          allowsRecordingIOS: true,
          playsInSilentModeIOS: true,
          interruptionModeIOS: InterruptionModeIOS.DoNotMix,
          interruptionModeAndroid: InterruptionModeAndroid.DoNotMix,
          shouldDuckAndroid: true,
          playThroughEarpieceAndroid: false,
          staysActiveInBackground: false,
        });
      } catch (err) {
        console.error("Initialization error:", err);
      }
    })();
  }, []);

  // Call Simulation
  useEffect(() => {
    let connectionTimeout;
    if (isVoiceCallActive || isVideoCallActive) {
      setCallStatus('Ringing...');
      setCallDuration(0);
      connectionTimeout = setTimeout(() => {
        setCallStatus('Connected');
        callTimerRef.current = setInterval(() => setCallDuration(prev => prev + 1), 1000);
      }, 2000);
    } else {
      if (callTimerRef.current) clearInterval(callTimerRef.current);
    }
    return () => {
      if (connectionTimeout) clearTimeout(connectionTimeout);
      if (callTimerRef.current) clearInterval(callTimerRef.current);
    };
  }, [isVoiceCallActive, isVideoCallActive]);

  const formatTime = (seconds) => {
    const mins = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  };

  const startRecording = async () => {
    if (!Voice || typeof Voice.start !== 'function') {
      Alert.alert("Unsupported Environment", "Voice recognition requires a Development Build. It is not supported in Expo Go.");
      return;
    }

    isHoldingMic.current = true;
    try {
      await Voice.start('en-US');
      // The `isRecording` state, animations, and timer will be managed by Voice.onSpeechStart
    } catch (err) {
      console.error('Failed to start recording', err);
      Alert.alert("Recording Error", "Could not start voice recording. Please check microphone permissions and try again.");
      isHoldingMic.current = false; // Reset if start fails
      // Ensure all recording-related UI is reset if starting fails
      setIsRecording(false);
      if (timerRef.current) clearInterval(timerRef.current);
      pulseAnim?.stopAnimation?.();
      pulseAnim?.setValue?.(0);
      stopWaveAnimation();
    }
  };
  const stopRecording = async () => {
    if (!Voice || typeof Voice.stop !== 'function') {
      setIsRecording(false);
      return;
    }

    isHoldingMic.current = false;
    try {
      await Voice.stop();
    } catch (error) {
      console.error("Failed to stop recording:", error);
      // If stopping fails, ensure UI reflects non-recording state
      setIsRecording(false);
      if (timerRef.current) clearInterval(timerRef.current);
      pulseAnim?.stopAnimation?.();
      pulseAnim?.setValue?.(0);
      stopWaveAnimation();
      Alert.alert("Recording Stop Error", "There was an issue stopping the voice recording.");
    }
  };
  const sendMessage = () => {
    if (inputText.trim().length === 0) return;

    if (editingMessageId) {
      setMessages(prev => prev.map(msg => 
        msg.id === editingMessageId ? { ...msg, text: inputText, timestamp: msg.timestamp + ' (edited)' } : msg
      ));
      setEditingMessageId(null);
      setInputText('');
      setSelectedMessageId(null);
      return;
    }

    const newMessage = {
      id: Date.now().toString(),
      text: inputText,
      sender: 'user',
      timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
      type: 'text',
      replyTo: replyingToMessage ? { id: replyingToMessage.id, text: replyingToMessage.text, sender: replyingToMessage.sender } : null,
    };

    setMessages(prev => [...prev, newMessage]);
    setInputText('');
    setReplyingToMessage(null);
    setIsJumping(false);
  };

  const deleteMessage = () => {
    setMessages(prev => prev.filter(m => m.id !== selectedMessageId));
    setIsMenuVisible(false);
    setSelectedMessageId(null);
    Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
  };

  const handleImagePicker = async () => {
    const result = await ImagePicker.launchImageLibraryAsync({ mediaTypes: ImagePicker.MediaTypeOptions.Images, allowsEditing: true, quality: 0.8 });
    if (!result.canceled) {
      const newMessage = {
        id: Date.now().toString(),
        uri: result.assets[0].uri,
        sender: 'user',
        timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
        type: 'image',
      };
      setMessages(prev => [...prev, newMessage]);
      setIsJumping(false);
    }
  };

  const scrollToMessage = (messageId) => {
    setIsJumping(true);
    const index = messages.findIndex(m => m.id === messageId);
    if (index !== -1) {
      flatListRef.current.scrollToIndex({ index, animated: true, viewPosition: 0.5 });
      setSelectedMessageId(messageId);
      setTimeout(() => {
        setSelectedMessageId(null);
        setIsJumping(false);
      }, 3000);
    }
  };

  const renderMessage = ({ item }) => {
    const isUser = item.sender === 'user';
    const isSelected = selectedMessageId === item.id;

    return (
      <TouchableOpacity 
        onLongPress={() => !item.isDeleted && setSelectedMessageId(item.id)}
        onPress={() => selectedMessageId && setSelectedMessageId(null)}
        activeOpacity={0.9}
        style={[styles.messageRow, isUser ? { alignItems: 'flex-end' } : { alignItems: 'flex-start' }]}
      >
        <View style={[styles.messageWrapper, isUser ? styles.userWrapper : styles.supportWrapper]}>
          {!isUser && (
            <View style={styles.supportAvatar}>
              <Ionicons name="headset" size={16} color={colors.white} />
            </View>
          )}
          <View style={[
            styles.messageBubble, 
            isUser ? styles.userBubble : styles.supportBubble,
            isSelected && styles.selectedBubble
          ]}>
            {item.replyTo && (
              <TouchableOpacity onPress={() => scrollToMessage(item.replyTo.id)} style={styles.replyQuote}>
                <Text style={styles.replyQuoteSender}>{item.replyTo.sender === 'user' ? 'You' : 'Support'}</Text>
                <Text style={styles.replyQuoteText} numberOfLines={1}>{item.replyTo.text}</Text>
              </TouchableOpacity>
            )}
            {item.type === 'text' ? (
              <Text style={[styles.messageText, isUser ? styles.userText : styles.supportText]}>{item.text}</Text>
            ) : (
              <Image source={{ uri: item.uri }} style={styles.messageImage} />
            )}
            <View style={styles.statusContainer}>
              <Text style={styles.timestamp}>{item.timestamp}</Text>
              {isUser && <Ionicons name="checkmark-done" size={14} color={colors.gold} style={{ marginLeft: 4 }} />}
            </View>
            {item.reaction && (
                <View style={[styles.reactionBadge, isUser ? { left: -10 } : { right: -10 }]}>
                  <Text style={{ fontSize: 12 }}>{item.reaction}</Text>
                </View>
            )}
          </View>
        </View>
      </TouchableOpacity>
    );
  };

  return (
    <SafeAreaView style={styles.container}>
      <StatusBar barStyle="light-content" backgroundColor={colors.primary} />
      
      {/* Header */}
      <View style={[styles.header, selectedMessageId && styles.selectionHeader]}>
        {selectedMessageId ? (
          <>
            <TouchableOpacity onPress={() => setSelectedMessageId(null)}>
              <Ionicons name="close" size={26} color={colors.primary} />
            </TouchableOpacity>
            <View style={styles.headerReactionRow}>
                {['👍', '❤️', '😂', '😮'].map(emoji => (
                    <TouchableOpacity key={emoji} onPress={() => {
                        setMessages(prev => prev.map(m => m.id === selectedMessageId ? {...m, reaction: emoji} : m));
                        setSelectedMessageId(null);
                    }}>
                        <Text style={{ fontSize: 20, marginHorizontal: 8 }}>{emoji}</Text>
                    </TouchableOpacity>
                ))}
            </View>
            <TouchableOpacity onPress={() => setIsMenuVisible(true)}>
              <Ionicons name="ellipsis-vertical" size={24} color={colors.primary} />
            </TouchableOpacity>
          </>
        ) : (
          <>
            <View style={{ flexDirection: 'row', alignItems: 'center' }}>
              <TouchableOpacity onPress={() => router.back()} style={{ marginRight: 15 }}>
                <Ionicons name="arrow-back" size={24} color={colors.primary} />
              </TouchableOpacity>
              <View>
                <Text style={styles.headerTitle}>Core Support</Text>
                <Text style={styles.headerSubtitle}>Online</Text>
              </View>
            </View>
            <View style={styles.headerActions}>
              <TouchableOpacity onPress={() => setIsVideoCallActive(true)}><Ionicons name="videocam" size={24} color={colors.gold} /></TouchableOpacity>
              <TouchableOpacity onPress={() => setIsVoiceCallActive(true)} style={{ marginLeft: 20 }}><Ionicons name="call" size={22} color={colors.gold} /></TouchableOpacity>
            </View>
          </>
        )}
      </View>

      <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} style={{ flex: 1 }} keyboardVerticalOffset={90}>
        <ImageBackground 
          source={{ uri: 'https://www.transparenttextures.com/patterns/diagmonds-light.png' }} 
          style={styles.chatBackground}
          imageStyle={{ opacity: 0.1, tintColor: colors.primary }}
        >
          <FlatList
            ref={flatListRef}
            data={messages}
            renderItem={renderMessage}
            keyExtractor={item => item.id}
            contentContainerStyle={{ padding: 15 }}
            onContentSizeChange={() => !isJumping && flatListRef.current.scrollToEnd({ animated: true })}
          />
        </ImageBackground>

        {replyingToMessage && (
          <View style={styles.replyPreview}>
            <View style={{ flex: 1 }}>
              <Text style={{ color: colors.gold, fontWeight: 'bold', fontSize: 12 }}>Replying to Support</Text>
              <Text style={{ color: colors.gray }} numberOfLines={1}>{replyingToMessage.text}</Text>
            </View>
            <TouchableOpacity onPress={() => setReplyingToMessage(null)}><Ionicons name="close-circle" size={20} color={colors.gray} /></TouchableOpacity>
          </View>
        )}

        <View style={styles.inputWrapper}>
          <TouchableOpacity onPress={handleImagePicker} style={{ marginRight: 10 }}>
            <Ionicons name="add-circle" size={30} color={colors.gold} />
          </TouchableOpacity>
          
          <View style={styles.textInputContainer}>
            {isRecording ? (
              <View style={styles.recordingRow}>
                <View style={styles.redDot} />
                <Text style={styles.recordingTimer}>{formatTime(recordingTime)}</Text>
                <Text style={{ color: colors.gray, fontSize: 12 }}>Recording speech...</Text>
              </View>
            ) : (
              <TextInput
                style={styles.input}
                placeholder="Type a message..."
                value={inputText}
                onChangeText={setInputText}
                multiline
              />
            )}
          </View>

          <View style={styles.micWrapper}>
            {isRecording && (
              <Animated.View style={[styles.pulse, { 
                transform: [{ scale: pulseAnim.interpolate({ inputRange: [0, 1], outputRange: [1, 2] }) }],
                opacity: pulseAnim.interpolate({ inputRange: [0, 1], outputRange: [0.5, 0] })
              }]} />
            )}
            <TouchableOpacity onPressIn={startRecording} onPressOut={stopRecording} style={[styles.micButton, isRecording && { backgroundColor: colors.danger }]}>
              <Ionicons name="mic" size={22} color={isRecording ? colors.white : colors.gray} />
            </TouchableOpacity>
          </View>

          <TouchableOpacity onPress={sendMessage} style={[styles.sendButton, !inputText.trim() && { backgroundColor: colors.border }]} disabled={!inputText.trim()}>
            <Ionicons name="send" size={18} color={colors.white} />
          </TouchableOpacity>
        </View>
      </KeyboardAvoidingView>

      {/* Menu Modal */}
      <Modal visible={isMenuVisible} transparent animationType="fade">
        <Pressable style={styles.modalOverlay} onPress={() => setIsMenuVisible(false)}>
            <View style={styles.menuBox}>
                <TouchableOpacity style={styles.menuItem} onPress={() => { setReplyingToMessage(messages.find(m => m.id === selectedMessageId)); setIsMenuVisible(false); setSelectedMessageId(null); }}>
                    <Ionicons name="arrow-undo" size={20} color={colors.primary} />
                    <Text style={styles.menuText}>Reply</Text>
                </TouchableOpacity>
                <TouchableOpacity style={styles.menuItem} onPress={async () => { 
                    try {
                        const msg = messages.find(m => m.id === selectedMessageId);
                        if (msg && msg.type === 'text') {
                          await Clipboard.setStringAsync(msg.text);
                          Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
                          setIsMenuVisible(false);
                          setSelectedMessageId(null);
                        } else {
                          Alert.alert("Cannot Copy", "Only text messages can be copied.");
                          setIsMenuVisible(false);
                        }
                    } catch (e) {
                        console.log("Copy to clipboard failed", e);
                        setIsMenuVisible(false);
                        setSelectedMessageId(null);
                    }
                }}>
                    <Ionicons name="copy" size={20} color={colors.primary} />
                    <Text style={styles.menuText}>Copy</Text>
                </TouchableOpacity>

                <TouchableOpacity style={[styles.menuItem, { borderTopWidth: 1, borderTopColor: colors.border, marginTop: 5 }]} onPress={deleteMessage}>
                    <Ionicons name="trash" size={20} color={colors.danger} />
                    <Text style={[styles.menuText, { color: colors.danger }]}>Delete</Text>
                </TouchableOpacity>
            </View>
        </Pressable>
      </Modal>

      {/* Call Overlays */}
      <Modal visible={isVoiceCallActive || isVideoCallActive} animationType="slide">
          <View style={[styles.callContainer, { backgroundColor: isVideoCallActive ? colors.black : colors.primary }]}>
              <View style={styles.callHeader}>
                  <Ionicons name="shield-checkmark" size={16} color={colors.gold} />
                  <Text style={{ color: colors.white, marginLeft: 8, fontSize: 12 }}>Secure Call</Text>
              </View>
              <View style={styles.callUserInfo}>
                  <View style={styles.callAvatar}><Ionicons name="person" size={60} color={colors.white} /></View>
                  <Text style={styles.callUserName}>Core Support Team</Text>
                  <Text style={styles.callStatus}>{callStatus === 'Connected' ? formatTime(callDuration) : callStatus}</Text>
              </View>
              <View style={styles.callControls}>
                  <TouchableOpacity style={styles.callBtn}><Ionicons name="mic-off" size={28} color={colors.white} /></TouchableOpacity>
                  <TouchableOpacity onPress={() => { setIsVoiceCallActive(false); setIsVideoCallActive(false); }} style={[styles.callBtn, { backgroundColor: colors.danger }]}><Ionicons name="call" size={28} color={colors.white} style={{ transform: [{ rotate: '135deg' }] }} /></TouchableOpacity>
                  <TouchableOpacity style={styles.callBtn}><Ionicons name="volume-high" size={28} color={colors.white} /></TouchableOpacity>
              </View>
          </View>
      </Modal>
    </SafeAreaView>
  );
};

export default GroupChatScreen;

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: colors.white },
  header: {
    flexDirection: 'row',
    padding: 15,
    paddingTop: Platform.OS === 'android' ? (StatusBar.currentHeight || 0) + 10 : 20,
    backgroundColor: colors.white,
    alignItems: 'center',
    justifyContent: 'space-between',
    borderBottomWidth: 1,
    borderBottomColor: colors.lightGray,
  },
  headerTitle: { fontWeight: '900', fontSize: 18, color: colors.primary },
  headerSubtitle: { fontSize: 12, color: '#10B981', fontWeight: 'bold' },
  headerActions: { flexDirection: 'row', alignItems: 'center' },
  selectionHeader: { backgroundColor: colors.lightBlue },
  headerReactionRow: { flexDirection: 'row', backgroundColor: colors.white, borderRadius: 20, padding: 5, elevation: 2 },
  
  chatBackground: { flex: 1, backgroundColor: colors.background },
  
  messageRow: { width: '100%', marginVertical: 4 },
  messageWrapper: { flexDirection: 'row', maxWidth: '85%' },
  userWrapper: { alignSelf: 'flex-end', paddingRight: 10 },
  supportWrapper: { alignSelf: 'flex-start', paddingLeft: 10 },
  
  supportAvatar: { width: 30, height: 30, borderRadius: 15, backgroundColor: colors.gold, justifyContent: 'center', alignItems: 'center', marginRight: 8, marginTop: 5 },
  
  messageBubble: { padding: 12, borderRadius: 18, elevation: 1 },
  userBubble: { backgroundColor: colors.primary, borderBottomRightRadius: 2 },
  supportBubble: { backgroundColor: colors.white, borderBottomLeftRadius: 2, borderWidth: 1, borderColor: colors.border },
  selectedBubble: { backgroundColor: colors.lightBlue, borderColor: colors.gold, borderWidth: 1 },

  messageText: { fontSize: 15, lineHeight: 20 },
  userText: { color: colors.white },
  supportText: { color: colors.text },
  
  messageImage: { width: 220, height: 220, borderRadius: 12, marginBottom: 5 },
  
  statusContainer: { flexDirection: 'row', alignItems: 'center', alignSelf: 'flex-end', marginTop: 4 },
  timestamp: { fontSize: 10, color: colors.muted },
  
  replyQuote: { backgroundColor: 'rgba(0,0,0,0.05)', padding: 8, borderRadius: 8, borderLeftWidth: 3, borderLeftColor: colors.gold, marginBottom: 8 },
  replyQuoteSender: { fontWeight: 'bold', fontSize: 11, color: colors.gold },
  replyQuoteText: { fontSize: 12, color: colors.gray },

  replyPreview: { flexDirection: 'row', alignItems: 'center', padding: 12, backgroundColor: colors.white, borderTopWidth: 1, borderTopColor: colors.border, borderLeftWidth: 5, borderLeftColor: colors.gold },

  inputWrapper: { flexDirection: 'row', padding: 12, alignItems: 'center', backgroundColor: colors.white, borderTopWidth: 1, borderTopColor: colors.lightGray },
  textInputContainer: { flex: 1, backgroundColor: colors.lightGray, borderRadius: 22, paddingHorizontal: 15, marginRight: 10, minHeight: 44, justifyContent: 'center' },
  input: { fontSize: 15, color: colors.black, maxHeight: 100 },
  
  recordingRow: { flexDirection: 'row', alignItems: 'center' },
  redDot: { width: 8, height: 8, borderRadius: 4, backgroundColor: colors.danger, marginRight: 8 },
  recordingTimer: { fontWeight: 'bold', color: colors.primary, marginRight: 10 },
  
  micWrapper: { width: 44, height: 44, justifyContent: 'center', alignItems: 'center', marginRight: 8 },
  micButton: { width: 40, height: 40, borderRadius: 20, backgroundColor: colors.lightGray, justifyContent: 'center', alignItems: 'center' },
  pulse: { position: 'absolute', width: 40, height: 40, borderRadius: 20, backgroundColor: colors.danger },
  
  sendButton: { width: 44, height: 44, borderRadius: 22, backgroundColor: colors.gold, justifyContent: 'center', alignItems: 'center' },

  reactionBadge: { position: 'absolute', bottom: -10, backgroundColor: colors.white, borderRadius: 10, paddingHorizontal: 5, borderWidth: 1, borderColor: colors.border },

  modalOverlay: { flex: 1, backgroundColor: 'rgba(0,0,0,0.2)', justifyContent: 'center', alignItems: 'center' },
  menuBox: { backgroundColor: colors.white, width: 180, borderRadius: 12, padding: 8, elevation: 5 },
  menuItem: { flexDirection: 'row', alignItems: 'center', padding: 12 },
  menuText: { marginLeft: 12, fontSize: 16, color: colors.primary, fontWeight: '600' },

  callContainer: { flex: 1, alignItems: 'center', justifyContent: 'space-between', paddingVertical: 80 },
  callHeader: { flexDirection: 'row', alignItems: 'center' },
  callUserInfo: { alignItems: 'center' },
  callAvatar: { width: 120, height: 120, borderRadius: 60, backgroundColor: 'rgba(255,255,255,0.1)', justifyContent: 'center', alignItems: 'center', marginBottom: 20 },
  callUserName: { color: colors.white, fontSize: 24, fontWeight: 'bold' },
  callStatus: { color: colors.gold, fontSize: 16, marginTop: 10 },
  callControls: { flexDirection: 'row', width: '100%', justifyContent: 'space-evenly' },
  callBtn: { width: 64, height: 64, borderRadius: 32, backgroundColor: 'rgba(255,255,255,0.2)', justifyContent: 'center', alignItems: 'center' },
});