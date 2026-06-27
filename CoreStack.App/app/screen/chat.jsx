// import React, { useState, useRef, useEffect, useCallback } from 'react';
// import {
//   StyleSheet,
//   Text,
//   View,
//   SafeAreaView,
//   TextInput,
//   TouchableOpacity,
//   FlatList,
//   KeyboardAvoidingView,
//   Platform,
//   Image,
//   ImageBackground,
//   Modal,
//   Animated,
//   Vibration,
//   StatusBar,
//   Alert,
//   Pressable,
// } from 'react-native';
// import * as Clipboard from 'expo-clipboard';
// import { Ionicons } from '@expo/vector-icons';
// import * as ImagePicker from 'expo-image-picker';
// import { Audio, InterruptionModeIOS, InterruptionModeAndroid } from 'expo-av';
// import * as Speech from 'expo-speech';
// import { useRouter } from 'expo-router';
// import { ExpoSpeechRecognitionModule, useSpeechRecognitionEvent } from 'expo-speech-recognition';
// import * as Haptics from 'expo-haptics';

// const colors = {
//     darkBlue: '#1A2B4C',
//     gold: '#D4AF37',
//     lightText: '#A7BCCF',
//     bgGray: '#f8f9fa',
// };

// const MOCK_MESSAGES = [
//   {
//     id: '1',
//     text: "Hello! Welcome to CoreStack Support. How can we assist you with your studies today?",
//     sender: 'support',
//     timestamp: '09:00 AM',
//     type: 'text',
//   },
//   {
//     id: '2',
//     text: "I'm having trouble accessing my CSC 401 materials.",
//     sender: 'user',
//     timestamp: '09:01 AM',
//     type: 'text',
//   },
// ];

// const GroupChatScreen = () => {
//   const router = useRouter();
//   const [messages, setMessages] = useState(MOCK_MESSAGES);
//   const [inputText, setInputText] = useState('');
//   const [selectedMessageId, setSelectedMessageId] = useState(null);
//   const [isMenuVisible, setIsMenuVisible] = useState(false);
//   const [isJumping, setIsJumping] = useState(false);
//   const [replyingToMessage, setReplyingToMessage] = useState(null);
//   const [editingMessageId, setEditingMessageId] = useState(null);
//   const flatListRef = useRef();

//   // Audio & Recording States
//   const [isRecording, setIsRecording] = useState(false);
//   const isHoldingMic = useRef(false);
//   const timerRef = useRef(null);
//   const [recordingTime, setRecordingTime] = useState(0);
  
//   // Call States
//   const [isVideoCallActive, setIsVideoCallActive] = useState(false);
//   const [isVoiceCallActive, setIsVoiceCallActive] = useState(false);
//   const [callStatus, setCallStatus] = useState('Connecting...');
//   const [callDuration, setCallDuration] = useState(0);
//   const callTimerRef = useRef(null);

//   // Animations
//   const pulseAnim = useRef(new Animated.Value(0)).current;
//   const waveAnims = useRef([new Animated.Value(0), new Animated.Value(0), new Animated.Value(0), new Animated.Value(0)]).current;

//   const startWaveAnimation = useCallback(() => {
//     const animations = waveAnims.map((anim, i) =>
//       Animated.loop(Animated.sequence([
//         Animated.timing(anim, { toValue: 1, duration: 300 + (i * 100), useNativeDriver: true }),
//         Animated.timing(anim, { toValue: 0, duration: 300 + (i * 100), useNativeDriver: true })
//       ]))
//     );
//     Animated.parallel(animations).start();
//   }, [waveAnims]);

//   // Speech Recognition Events
//   useSpeechRecognitionEvent("start", () => {
//     setIsRecording(true);
//     setRecordingTime(0);
//     timerRef.current = setInterval(() => setRecordingTime(prev => prev + 1), 1000);
    
//     Animated.loop(Animated.sequence([
//       Animated.timing(pulseAnim, { toValue: 1, duration: 1000, useNativeDriver: true }),
//       Animated.timing(pulseAnim, { toValue: 0, duration: 1000, useNativeDriver: true }),
//     ])).start();
    
//     startWaveAnimation();
//     if (Platform.OS !== 'web') Vibration.vibrate(50);
//   });

//   useSpeechRecognitionEvent("result", (event) => {
//     // Update the input text with the transcript as you speak
//     if (event.results && event.results.length > 0) {
//       setInputText(event.results[0].transcript);
//     }
//   });

//   useSpeechRecognitionEvent("error", (event) => {
//     console.log("Speech Recognition Error:", event.error, event.message);
//     stopRecording();
//     Alert.alert("Speech Error", "Could not process speech. Please try again.");
//   });

//   useSpeechRecognitionEvent("end", () => {
//     stopRecording();
//     Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
//   });

//   const stopWaveAnimation = useCallback(() => {
//     waveAnims.forEach(anim => anim.stopAnimation());
//     waveAnims.forEach(anim => anim.setValue(0));
//   }, [waveAnims]);

//   useEffect(() => {
//     return () => {
//       if (timerRef.current) clearInterval(timerRef.current);
//       if (isRecording) {
//         ExpoSpeechRecognitionModule.stop();
//       }
//       pulseAnim.stopAnimation();
//       pulseAnim.setValue(0);
//       Speech.stop();
//       stopWaveAnimation();
//     };
//   }, [pulseAnim, startWaveAnimation, stopWaveAnimation]); // Dependencies for useCallback functions

//   useEffect(() => {
//     (async () => {
//       try {
//         await Audio.requestPermissionsAsync();
//         await ImagePicker.requestMediaLibraryPermissionsAsync();
//         // Set audio mode once for recording, this is a good default for voice input
//         await Audio.setAudioModeAsync({
//           allowsRecordingIOS: true,
//           playsInSilentModeIOS: true,
//           interruptionModeIOS: InterruptionModeIOS.DoNotMix,
//           interruptionModeAndroid: InterruptionModeAndroid.DoNotMix,
//           shouldDuckAndroid: true,
//           playThroughEarpieceAndroid: false,
//           staysActiveInBackground: false,
//         });
//       } catch (err) {
//         console.error("Initialization error:", err);
//       }
//     })();
//   }, []);

//   // Call Simulation
//   useEffect(() => {
//     let connectionTimeout;
//     if (isVoiceCallActive || isVideoCallActive) {
//       setCallStatus('Ringing...');
//       setCallDuration(0);
//       connectionTimeout = setTimeout(() => {
//         setCallStatus('Connected');
//         callTimerRef.current = setInterval(() => setCallDuration(prev => prev + 1), 1000);
//       }, 2000);
//     } else {
//       if (callTimerRef.current) clearInterval(callTimerRef.current);
//     }
//     return () => {
//       if (connectionTimeout) clearTimeout(connectionTimeout);
//       if (callTimerRef.current) clearInterval(callTimerRef.current);
//     };
//   }, [isVoiceCallActive, isVideoCallActive]);

//   const formatTime = (seconds) => {
//     const mins = Math.floor(seconds / 60);
//     const secs = seconds % 60;
//     return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
//   };

//   const handleSpeak = async (text) => {
//     const isAlreadySpeaking = await Speech.isSpeakingAsync();
//     if (isAlreadySpeaking) {
//       await Speech.stop();
//     }
//     Speech.speak(text);
//   };

//   const startRecording = async () => {
//     const result = await ExpoSpeechRecognitionModule.requestPermissionsAsync();
//     if (!result.granted) {
//       Alert.alert("Permission Denied", "Microphone access is required for speech recognition.");
//       return;
//     }

//     isHoldingMic.current = true;
//     ExpoSpeechRecognitionModule.start({
//       lang: "en-US",
//       interimResults: true, // This allows text to update while you are still speaking
//     });
//   };

//   const stopRecording = async () => {
//     isHoldingMic.current = false;
//     ExpoSpeechRecognitionModule.stop();
//     setIsRecording(false);
//     if (timerRef.current) clearInterval(timerRef.current);
//     pulseAnim.stopAnimation();
//     pulseAnim.setValue(0);
//     stopWaveAnimation();
//   };
//   const sendMessage = () => {
//     if (inputText.trim().length === 0) return;

//     if (editingMessageId) {
//       setMessages(prev => prev.map(msg => 
//         msg.id === editingMessageId ? { ...msg, text: inputText, isEdited: true } : msg
//       ));
//       setEditingMessageId(null);
//       setInputText('');
//       setSelectedMessageId(null);
//       return;
//     }

//     const newMessage = {
//       id: Date.now().toString(),
//       text: inputText,
//       sender: 'user',
//       timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
//       type: 'text',
//       replyTo: replyingToMessage ? { id: replyingToMessage.id, text: replyingToMessage.text, sender: replyingToMessage.sender } : null,
//     };

//     setMessages(prev => [...prev, newMessage]);
//     setInputText('');
//     setReplyingToMessage(null);
//     setIsJumping(false);
//   };

//   const deleteMessage = () => {
//     setMessages(prev => prev.map(m => 
//       m.id === selectedMessageId 
//         ? { ...m, isDeleted: true, text: '', type: 'text', uri: null, reaction: null, replyTo: null } 
//         : m
//     ));
//     setIsMenuVisible(false);
//     setSelectedMessageId(null);
//     Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
//   };

//   const handleImagePicker = async () => {
//     const result = await ImagePicker.launchImageLibraryAsync({ mediaTypes: ImagePicker.MediaTypeOptions.Images, allowsEditing: true, quality: 0.8 });
//     if (!result.canceled) {
//       const newMessage = {
//         id: Date.now().toString(),
//         uri: result.assets[0].uri,
//         sender: 'user',
//         timestamp: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
//         type: 'image',
//       };
//       setMessages(prev => [...prev, newMessage]);
//       setIsJumping(false);
//     }
//   };

//   const scrollToMessage = (messageId) => {
//     setIsJumping(true);
//     const index = messages.findIndex(m => m.id === messageId);
//     if (index !== -1) {
//       flatListRef.current.scrollToIndex({ index, animated: true, viewPosition: 0.5 });
//       setSelectedMessageId(messageId);
//       setTimeout(() => {
//         setSelectedMessageId(null);
//         setIsJumping(false);
//       }, 3000);
//     }
//   };

//   const renderMessage = ({ item }) => {
//     const isUser = item.sender === 'user';
//     const isSelected = selectedMessageId === item.id;
//     const isDeleted = item.isDeleted;

//     return (
//       <TouchableOpacity 
//         onLongPress={() => !item.isDeleted && setSelectedMessageId(item.id)}
//         onPress={() => selectedMessageId && setSelectedMessageId(null)}
//         activeOpacity={0.9}
//         style={[styles.messageRow, isUser ? { alignItems: 'flex-end' } : { alignItems: 'flex-start' }]}
//       >
//         <View style={[styles.messageWrapper, isUser ? styles.userWrapper : styles.supportWrapper]}>
//           {!isUser && <Text style={styles.senderName}>Usman Adams</Text>}
//           <View style={[
//             styles.messageBubble, 
//             isUser ? styles.userBubble : styles.supportBubble,
//             isSelected && styles.selectedBubble,
//             isDeleted && (isUser ? styles.deletedBubbleUser : styles.deletedBubbleSupport)
//           ]}>
//             {!isDeleted && item.replyTo && (
//               <TouchableOpacity onPress={() => scrollToMessage(item.replyTo.id)} style={styles.replyQuote}>
//                 <Text style={styles.replyQuoteSender}>{item.replyTo.sender === 'user' ? 'You' : 'Support'}</Text>
//                 <Text style={styles.replyQuoteText} numberOfLines={1}>{item.replyTo.text}</Text>
//               </TouchableOpacity>
//             )}

//             {isDeleted ? (
//               <View style={styles.deletedContainer}>
//                 <Ionicons name="ban" size={14} color={isUser ? 'rgba(255,255,255,0.6)' : colors.lightText} style={{ marginRight: 5 }} />
//                 <Text style={[styles.messageText, styles.deletedText, isUser ? styles.userText : styles.supportText]}>
//                   {isUser ? 'You deleted this message' : 'This message was deleted'}
//                 </Text>
//               </View>
//             ) : item.type === 'text' ? (
//               <Text style={[styles.messageText, isUser ? styles.userText : styles.supportText]}>{item.text}</Text>
//             ) : (
//               <Image source={{ uri: item.uri }} style={styles.messageImage} />
//             )}
//             <View style={styles.statusContainer}>
//               {item.isEdited && <Text style={[styles.timestamp, { fontStyle: 'italic', marginRight: 4 }]}>edited</Text>}
//               <Text style={styles.timestamp}>{item.timestamp}</Text>
//               {isUser && !isDeleted && <Ionicons name="checkmark-done" size={14} color={colors.gold} style={{ marginLeft: 4 }} />}
//             </View>
//             {!isDeleted && item.reaction && (
//                 <View style={[styles.reactionBadge, isUser ? { left: -10 } : { right: -10 }]}>
//                   <Text style={{ fontSize: 12 }}>{item.reaction}</Text>
//                 </View>
//             )}
//           </View>
//         </View>
//       </TouchableOpacity>
//     );
//   };

//   return (
//     <>
//       <StatusBar barStyle="light-content" backgroundColor={colors.darkBlue} />
//     <SafeAreaView style={styles.container}>
    
      
//       {/* Header */}
//       <View style={[styles.header, selectedMessageId && styles.selectionHeader]}>
//         {selectedMessageId ? (
//           <>
//             <TouchableOpacity onPress={() => setSelectedMessageId(null)}>
//               <Ionicons name="close" size={26} color={colors.darkBlue} />
//             </TouchableOpacity>
//             <View style={styles.headerReactionRow}>
//                 {['👍', '❤️', '😂', '😮'].map(emoji => (
//                     <TouchableOpacity key={emoji} onPress={() => {
//                         setMessages(prev => prev.map(m => m.id === selectedMessageId ? {...m, reaction: emoji} : m));
//                         setSelectedMessageId(null);
//                     }}>
//                         <Text style={{ fontSize: 20, marginHorizontal: 8 }}>{emoji}</Text>
//                     </TouchableOpacity>
//                 ))}
//             </View>
//             <TouchableOpacity onPress={() => setIsMenuVisible(true)}>
//               <Ionicons name="ellipsis-vertical" size={24} color={colors.darkBlue} />
//             </TouchableOpacity>
//           </>
//         ) : (
//           <>
//             <View style={{ flexDirection: 'row', alignItems: 'center' }}>
//               <TouchableOpacity onPress={() => router.back()} style={{ marginRight: 15 }}>
//                 <Ionicons name="arrow-back" size={24} color={colors.white} />
//               </TouchableOpacity>
//               <View style={{ flexDirection: 'row', alignItems: 'center' }}>
//                 <Ionicons name="person-circle-outline" size={26} color={colors.gold} style={{ marginRight: 8 }} />
//                 <Text style={styles.headerTitle}>Group Chat</Text>
//               </View>
//             </View>
//             <View style={styles.headerActions}>
//               <TouchableOpacity onPress={() => setIsVideoCallActive(true)}><Ionicons name="videocam" size={24} color={colors.gold} /></TouchableOpacity>
//               <TouchableOpacity onPress={() => setIsVoiceCallActive(true)} style={{ marginLeft: 20 }}><Ionicons name="call" size={22} color={colors.gold} /></TouchableOpacity>
//             </View>
//           </>
//         )}
//       </View>

//       <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} style={{ flex: 1 }} keyboardVerticalOffset={90}>
//         <ImageBackground 
//           source={{ uri: 'https://www.transparenttextures.com/patterns/stardust.png' }}  
//           style={styles.chatBackground}
//           imageStyle={{ opacity: 0.15, tintColor: '#ffffff' }}
//         >
//           <FlatList
//             ref={flatListRef}
//             data={messages}
//             renderItem={renderMessage}
//             keyExtractor={item => item.id}
//             contentContainerStyle={{ padding: 15 }}
//             onContentSizeChange={() => !isJumping && flatListRef.current.scrollToEnd({ animated: true })}
//           />
//         </ImageBackground>

//         {replyingToMessage && (
//           <View style={styles.replyPreview}>
//             <View style={{ flex: 1 }}>
//               <Text style={{ color: colors.gold, fontWeight: 'bold', fontSize: 12 }}>Replying to Support</Text>
//               <Text style={{ color: colors.lightText }} numberOfLines={1}>{replyingToMessage.text}</Text>
//             </View>
//             <TouchableOpacity onPress={() => setReplyingToMessage(null)}><Ionicons name="close-circle" size={20} color={colors.lightText} /></TouchableOpacity>
//           </View>
//         )}

//         {editingMessageId && (
//           <View style={styles.editPreview}>
//             <View style={{ flex: 1 }}>
//               <Text style={{ color: colors.gold, fontWeight: 'bold', fontSize: 12 }}>Editing message</Text>
//               <Text style={{ color: colors.lightText }} numberOfLines={1}>
//                 {messages.find(m => m.id === editingMessageId)?.text}
//               </Text>
//             </View>
//             <TouchableOpacity onPress={() => { setEditingMessageId(null); setInputText(''); }}>
//               <Ionicons name="close-circle" size={20} color={colors.lightText} />
//             </TouchableOpacity>
//           </View>
//         )}

//         <View style={styles.inputWrapper}>
//           <TouchableOpacity onPress={handleImagePicker} style={{ marginRight: 10 }}>
//             <Ionicons name="add-circle" size={30} color={colors.gold} />
//           </TouchableOpacity>
          
//           <View style={styles.textInputContainer}>
//             {isRecording ? (
//               <View style={styles.recordingRow}>
//                 <View style={styles.redDot} />
//                 <Text style={styles.recordingTimer}>{formatTime(recordingTime)}</Text>
//                 <Text style={{ color: colors.lightText, fontSize: 12 }}>Recording speech...</Text>
//               </View>
//             ) : (
//               <TextInput
//                 style={styles.input}
//                 placeholder="Type a message..."
//                 value={inputText}
//                 onChangeText={setInputText}
//                 multiline
//               />
//             )}
//           </View>

//           <View style={styles.micWrapper}>
//             {isRecording && (
//               <Animated.View style={[styles.pulse, { 
//                 transform: [{ scale: pulseAnim.interpolate({ inputRange: [0, 1], outputRange: [1, 2] }) }],
//                 opacity: pulseAnim.interpolate({ inputRange: [0, 1], outputRange: [0.5, 0] })
//               }]} />
//             )}
//             <TouchableOpacity onPressIn={startRecording} onPressOut={stopRecording} style={[styles.micButton, isRecording && { backgroundColor: '#EF4444' }]}>
//               <Ionicons name="mic" size={22} color={isRecording ? '#FFFFFF' : colors.lightText} />
//             </TouchableOpacity>
//           </View>

//           <TouchableOpacity onPress={sendMessage} style={[styles.sendButton, !inputText.trim() && { backgroundColor: 'rgba(26,43,76,0.15)' }]} disabled={!inputText.trim()}>
//             <Ionicons name="send" size={18} color="#FFFFFF" />
//           </TouchableOpacity>
//         </View>
//       </KeyboardAvoidingView>

//       {/* Menu Modal */}
//       <Modal visible={isMenuVisible} transparent animationType="fade">
//         <Pressable style={styles.modalOverlay} onPress={() => setIsMenuVisible(false)}>
//             <View style={styles.menuBox}>
//                 <TouchableOpacity style={styles.menuItem} onPress={() => { 
//                   setReplyingToMessage(messages.find(m => m.id === selectedMessageId)); 
//                   setEditingMessageId(null);
//                   setIsMenuVisible(false); 
//                   setSelectedMessageId(null); 
//                 }}>
//                     <Ionicons name="arrow-undo" size={20} color={colors.darkBlue} />
//                     <Text style={styles.menuText}>Reply</Text>
//                 </TouchableOpacity>

//                 <TouchableOpacity style={styles.menuItem} onPress={() => {
//                     const msg = messages.find(m => m.id === selectedMessageId);
//                     if (msg && msg.text && !msg.isDeleted) {
//                         handleSpeak(msg.text);
//                         setIsMenuVisible(false);
//                         setSelectedMessageId(null);
//                         Haptics.selectionAsync();
//                     } else {
//                         Alert.alert("Cannot Read", "Only text messages can be read aloud.");
//                         setIsMenuVisible(false);
//                     }
//                 }}>
//                     <Ionicons name="volume-high" size={20} color={colors.darkBlue} />
//                     <Text style={styles.menuText}>Read Aloud</Text>
//                 </TouchableOpacity>

//                 {(() => {
//                   const msg = messages.find(m => m.id === selectedMessageId);
//                   if (msg?.sender === 'user' && !msg.isDeleted && msg.type === 'text') {
//                     return (
//                       <TouchableOpacity style={styles.menuItem} onPress={() => {
//                         setEditingMessageId(selectedMessageId);
//                         setInputText(msg.text);
//                         setReplyingToMessage(null);
//                         setIsMenuVisible(false);
//                         setSelectedMessageId(null);
//                       }}>
//                         <Ionicons name="pencil" size={20} color={colors.darkBlue} />
//                         <Text style={styles.menuText}>Edit</Text>
//                       </TouchableOpacity>
//                     );
//                   }
//                   return null;
//                 })()}

//                 <TouchableOpacity style={styles.menuItem} onPress={async () => { 
//                     try {
//                         const msg = messages.find(m => m.id === selectedMessageId);
//                         if (msg && msg.type === 'text') {
//                           await Clipboard.setStringAsync(msg.text);
//                           Haptics.notificationAsync(Haptics.NotificationFeedbackType.Success);
//                           setIsMenuVisible(false);
//                           setSelectedMessageId(null);
//                         } else {
//                           Alert.alert("Cannot Copy", "Only text messages can be copied.");
//                           setIsMenuVisible(false);
//                         }
//                     } catch (e) {
//                         console.log("Copy to clipboard failed", e);
//                         setIsMenuVisible(false);
//                         setSelectedMessageId(null);
//                     }
//                 }}>
//                     <Ionicons name="copy" size={20} color={colors.darkBlue} />
//                     <Text style={styles.menuText}>Copy</Text>
//                 </TouchableOpacity>

//                 <TouchableOpacity style={[styles.menuItem, { borderTopWidth: 1, borderTopColor: 'rgba(167,188,207,0.35)', marginTop: 5 }]} onPress={deleteMessage}>
//                     <Ionicons name="trash" size={20} color="#EF4444" />
//                     <Text style={[styles.menuText, { color: '#EF4444' }]}>Delete</Text>
//                 </TouchableOpacity>
//             </View>
//         </Pressable>
//       </Modal>

//       {/* Call Overlays */}
//       <Modal visible={isVoiceCallActive || isVideoCallActive} animationType="slide">
//           <View style={[styles.callContainer, { backgroundColor: colors.darkBlue }]}>
//               <View style={styles.callHeader}>
//                   <Ionicons name="shield-checkmark" size={16} color={colors.gold} />
//                   <Text style={{ color: '#FFFFFF', marginLeft: 8, fontSize: 12 }}>Secure Call</Text>
//               </View>
//               <View style={styles.callUserInfo}>
//                   <View style={styles.callAvatar}><Ionicons name="person" size={60} color="#FFFFFF" /></View>
//                   <Text style={styles.callUserName}>Core Support Team</Text>
//                   <Text style={styles.callStatus}>{callStatus === 'Connected' ? formatTime(callDuration) : callStatus}</Text>
//               </View>
//               <View style={styles.callControls}>
//                   <TouchableOpacity style={styles.callBtn}><Ionicons name="mic-off" size={28} color="#FFFFFF" /></TouchableOpacity>
//                   <TouchableOpacity onPress={() => { setIsVoiceCallActive(false); setIsVideoCallActive(false); }} style={[styles.callBtn, { backgroundColor: '#EF4444' }]}><Ionicons name="call" size={28} color="#FFFFFF" style={{ transform: [{ rotate: '135deg' }] }} /></TouchableOpacity>
//                   <TouchableOpacity style={styles.callBtn}><Ionicons name="volume-high" size={28} color="#FFFFFF" /></TouchableOpacity>
//               </View>
//           </View>
//       </Modal>
//     </SafeAreaView>
//     </>
//   );
// };

// export default GroupChatScreen;

// const styles = StyleSheet.create({
//   container: { flex: 1, backgroundColor: '#FFFFFF' },
//   header: {
//     flexDirection: 'row',
//     padding: 15,
//     paddingTop: Platform.OS === 'android' ? (StatusBar.currentHeight || 0) + 10 : 20,
//     backgroundColor: colors.darkBlue,
//     alignItems: 'center',
//     justifyContent: 'space-between',
//     borderBottomWidth: 1,
//     borderBottomColor: 'rgba(167,188,207,0.35)',
//   },
//   headerTitle: { fontWeight: '900', fontSize: 18, color: '#FFFFFF' },
//   headerSubtitle: { fontSize: 12, color: colors.gold, fontWeight: 'bold' },
//   headerActions: { flexDirection: 'row', alignItems: 'center' },
//   selectionHeader: { backgroundColor: 'rgba(212,175,55,0.12)' },
//   headerReactionRow: { flexDirection: 'row', backgroundColor: '#FFFFFF', borderRadius: 20, padding: 5, elevation: 2 },
  
//   chatBackground: { flex: 1, backgroundColor: colors.bgGray },
  
//   messageRow: { width: '100%', marginVertical: 4 },
//   messageWrapper: { maxWidth: '85%' },
//   userWrapper: { alignSelf: 'flex-end', paddingRight: 10 },
//   supportWrapper: { alignSelf: 'flex-start', paddingLeft: 10 },
  
//   senderName: { fontSize: 13, fontWeight: '700', color: colors.darkBlue, marginBottom: 2, marginLeft: 4 },

//   messageBubble: { padding: 12, borderRadius: 18, elevation: 1 },
//   userBubble: { backgroundColor: colors.darkBlue, borderBottomRightRadius: 2 },
//   supportBubble: { backgroundColor: '#FFFFFF', borderBottomLeftRadius: 2, borderWidth: 1, borderColor: 'rgba(26,43,76,0.12)' },
//   selectedBubble: { backgroundColor: 'rgba(26,43,76,0.12)', borderColor: colors.gold, borderWidth: 1 },

//   deletedBubbleUser: { opacity: 0.8 },
//   deletedBubbleSupport: { backgroundColor: 'rgba(26,43,76,0.12)', borderColor: 'rgba(26,43,76,0.15)' },
//   deletedContainer: { flexDirection: 'row', alignItems: 'center' },
//   deletedText: { fontStyle: 'italic', opacity: 0.7 },

//   messageText: { fontSize: 15, lineHeight: 20 },
//   userText: { color: '#FFFFFF' },
//   supportText: { color: colors.darkBlue },
  
//   messageImage: { width: 220, height: 220, borderRadius: 12, marginBottom: 5 },
  
//   statusContainer: { flexDirection: 'row', alignItems: 'center', alignSelf: 'flex-end', marginTop: 4 },
//   timestamp: { fontSize: 10, color: colors.lightText },
  
//   replyQuote: { backgroundColor: 'rgba(212,175,55,0.12)', padding: 8, borderRadius: 8, borderLeftWidth: 3, borderLeftColor: colors.gold, marginBottom: 8 },
//   replyQuoteSender: { fontWeight: 'bold', fontSize: 11, color: colors.gold },
//   replyQuoteText: { fontSize: 12, color: colors.lightText },

//   replyPreview: { flexDirection: 'row', alignItems: 'center', padding: 12, backgroundColor: '#FFFFFF', borderTopWidth: 1, borderTopColor: 'rgba(167,188,207,0.35)', borderLeftWidth: 5, borderLeftColor: colors.gold },
//   editPreview: { flexDirection: 'row', alignItems: 'center', padding: 12, backgroundColor: '#FFFFFF', borderTopWidth: 1, borderTopColor: 'rgba(167,188,207,0.35)', borderLeftWidth: 5, borderLeftColor: colors.gold },

//   inputWrapper: { flexDirection: 'row', padding: 12, alignItems: 'center', backgroundColor: '#FFFFFF', borderTopWidth: 1, borderTopColor: 'rgba(167,188,207,0.35)' },
//   textInputContainer: { flex: 1, backgroundColor: '#FFFFFF', borderRadius: 22, paddingHorizontal: 15, marginRight: 10, minHeight: 44, justifyContent: 'center' },
//   input: { fontSize: 15, color: colors.darkBlue, maxHeight: 100 },
  
//   recordingRow: { flexDirection: 'row', alignItems: 'center' },
//   redDot: { width: 8, height: 8, borderRadius: 4, backgroundColor: '#EF4444', marginRight: 8 },
//   recordingTimer: { fontWeight: 'bold', color: colors.darkBlue, marginRight: 10 },
  
//   micWrapper: { width: 44, height: 44, justifyContent: 'center', alignItems: 'center', marginRight: 8 },
//   micButton: { width: 40, height: 40, borderRadius: 20, backgroundColor: 'rgba(26,43,76,0.08)', justifyContent: 'center', alignItems: 'center' },
//   pulse: { position: 'absolute', width: 40, height: 40, borderRadius: 20, backgroundColor: '#EF4444' },
  
//   sendButton: { width: 44, height: 44, borderRadius: 22, backgroundColor: colors.gold, justifyContent: 'center', alignItems: 'center' },

//   reactionBadge: { position: 'absolute', bottom: -10, backgroundColor: '#FFFFFF', borderRadius: 10, paddingHorizontal: 5, borderWidth: 1, borderColor: 'rgba(167,188,207,0.35)' },

//   modalOverlay: { flex: 1, backgroundColor: 'rgba(0,0,0,0.2)', justifyContent: 'center', alignItems: 'center' },
//   menuBox: { backgroundColor: '#FFFFFF', width: 180, borderRadius: 12, padding: 8, elevation: 5 },
//   menuItem: { flexDirection: 'row', alignItems: 'center', padding: 12 },
//   menuText: { marginLeft: 12, fontSize: 16, color: colors.darkBlue, fontWeight: '600' },

//   callContainer: { flex: 1, alignItems: 'center', justifyContent: 'space-between', paddingVertical: 80 },
//   callHeader: { flexDirection: 'row', alignItems: 'centerr' },
//   callUserInfo: { alignItems: 'center' },
//   callAvatar: { width: 120, height: 120, borderRadius: 60, backgroundColor: 'rgba(255,255,255,0.1)', justifyContent: 'center', alignItems: 'center', marginBottom: 20 },
//   callUserName: { color: '#FFFFFF', fontSize: 24, fontWeight: 'bold' },
//   callStatus: { color: colors.gold, fontSize: 16, marginTop: 10 },
//   callControls: { flexDirection: 'row', width: '100%', justifyContent: 'space-evenly' },
//   callBtn: { width: 64, height: 64, borderRadius: 32, backgroundColor: 'rgba(255,255,255,0.2)', justifyContent: 'center', alignItems: 'center' },
// });