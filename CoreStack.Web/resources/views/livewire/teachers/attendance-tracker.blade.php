<div id="attendance-tracker-container" x-data="{ 
    openModal: false, 
    scannerActive: false,
    status: 'idle', 
    statusMessage: '',
    scannedStudent: null,
    countdown: 3,
    countdownTimer: null,
    
    setScanState(newStatus, message, student = null) {
        this.status = newStatus;
        this.statusMessage = message;
        if (student) {
            this.scannedStudent = student;
        }
        
        if (newStatus !== 'processing' && newStatus !== 'idle') {
            this.countdown = 3;
            if (this.countdownTimer) clearInterval(this.countdownTimer);
            this.countdownTimer = setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    this.resetScanState();
                }
            }, 1000);
        }
    },
    
    resetScanState() {
        if (this.countdownTimer) {
            clearInterval(this.countdownTimer);
            this.countdownTimer = null;
        }
        this.status = 'idle';
        this.statusMessage = '';
        isProcessing = false;
    },

    stopScannerApp() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear().then(() => {
                console.log('Scanner cleared successfully via Alpine.');
                html5QrcodeScanner = null;
                this.scannerActive = false;
                this.resetScanState();
            }).catch(err => {
                console.warn('Scanner clear failed, resetting state:', err);
                html5QrcodeScanner = null;
                this.scannerActive = false;
                this.resetScanState();
            });
        } else {
            this.scannerActive = false;
            this.resetScanState();
        }
    }
}">
    <div class="mb-8">
        <h1 class="text-2xl font-black text-darkblue tracking-tight">ATTENDANCE TRACKER</h1>
        <p class="text-sm text-stone-500">Scan student QR codes to record attendance for the current lecture.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- QR Scanner Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-100 bg-stone-50/50 flex justify-between items-center">
                    <h3 class="text-sm font-black text-darkblue uppercase tracking-widest">Live Scanner</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse" :class="scannerActive ? 'bg-green-500' : 'bg-stone-300 animate-none'"></span>
                            <span class="text-[10px] font-bold text-stone-500 uppercase" x-text="scannerActive ? 'Camera Active' : 'Camera Off'">Camera Off</span>
                        </div>
                        <template x-if="scannerActive">
                            <button @click="stopScannerApp()" class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 text-[10px] font-black rounded-lg uppercase tracking-widest transition border border-red-200">
                                Turn Off
                            </button>
                        </template>
                    </div>
                </div>
                <div class="p-8">
                    <!-- Scanner Container -->
                    <div id="reader" class="w-full rounded-xl overflow-hidden border-2 border-stone-200 bg-stone-50 aspect-video flex items-center justify-center relative shadow-inner">
                        <!-- 1. Scanner Camera View Target -->
                        <div id="qr-reader-target" x-show="scannerActive" class="w-full h-full" style="display: none;"></div>

                        <!-- 2. Idle State -->
                        <div x-show="!scannerActive" class="text-center p-4">
                            <svg class="w-12 h-12 mx-auto text-stone-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v-4m6 0h-2m-6 0H4m0 6V4m16 6V4m0 16v-4m-16 0v4m0-16h2m12 0h2M4 12h2m12 0h2m-6 0h-2"></path>
                            </svg>
                            <p class="text-xs font-bold text-stone-400 uppercase tracking-tighter mb-4">Scanner is currently idle</p>
                            <button @click="scannerActive = true; startScanner()" class="px-6 py-3 bg-darkblue text-white text-[10px] font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-lg shadow-darkblue/20">
                                Launch Camera
                            </button>
                        </div>

                        <!-- 3. Dynamic Overlay for Processing, Success, Duplicate, or Error States -->
                        <div x-show="status !== 'idle' && scannerActive" 
                             x-cloak
                             x-transition.opacity 
                             class="absolute inset-0 z-10 flex flex-col items-center justify-center p-6 backdrop-blur-md transition-all duration-300"
                             :class="{
                                 'bg-darkblue/90 text-white': status === 'processing',
                                 'bg-emerald-600/95 text-white': status === 'success',
                                 'bg-amber-600/95 text-white': status === 'duplicate',
                                 'bg-red-600/95 text-white': status === 'error'
                             }"
                             style="display: none;">
                             
                             <!-- A. PROCESSING STATE -->
                             <div x-show="status === 'processing'" class="text-center space-y-4">
                                 <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-white/30 border-t-white"></div>
                                 <div>
                                     <p class="text-[10px] font-bold text-gold uppercase tracking-widest mb-1">Verifying QR Code</p>
                                     <h4 class="text-base font-black tracking-tight" x-text="statusMessage">Processing scan...</h4>
                                 </div>
                             </div>

                             <!-- B. SUCCESS STATE -->
                             <div x-show="status === 'success'" class="text-center space-y-4">
                                 <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 text-white animate-bounce">
                                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                     </svg>
                                 </div>
                                 <div class="px-4">
                                     <p class="text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1">Attendance Recorded</p>
                                     <h4 class="text-base font-black tracking-tight" x-text="statusMessage">Success</h4>
                                     <template x-if="scannedStudent">
                                         <p class="text-xs font-semibold mt-2 bg-white/10 py-1 px-3 rounded-full inline-block" x-text="scannedStudent.name"></p>
                                     </template>
                                 </div>
                                 <!-- Countdown / Resume Button -->
                                 <div class="pt-2">
                                     <button @click="resetScanState()" class="px-5 py-2.5 bg-white text-emerald-600 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-white/95 transition shadow-lg">
                                         Scan Next (<span x-text="countdown">3</span>s)
                                     </button>
                                 </div>
                             </div>

                             <!-- C. DUPLICATE STATE -->
                             <div x-show="status === 'duplicate'" class="text-center space-y-4">
                                 <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 text-white">
                                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                     </svg>
                                 </div>
                                 <div class="px-4">
                                     <p class="text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1">Duplicate Entry</p>
                                     <h4 class="text-base font-black tracking-tight" x-text="statusMessage">Already recorded</h4>
                                     <template x-if="scannedStudent">
                                         <p class="text-xs font-semibold mt-2 bg-white/10 py-1 px-3 rounded-full inline-block" x-text="scannedStudent.name"></p>
                                     </template>
                                 </div>
                                 <!-- Countdown / Resume Button -->
                                 <div class="pt-2">
                                     <button @click="resetScanState()" class="px-5 py-2.5 bg-white text-amber-600 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-white/95 transition shadow-lg">
                                         Scan Next (<span x-text="countdown">3</span>s)
                                     </button>
                                 </div>
                             </div>

                             <!-- D. ERROR STATE -->
                             <div x-show="status === 'error'" class="text-center space-y-4">
                                 <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 text-white">
                                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                     </svg>
                                 </div>
                                 <div class="px-4">
                                     <p class="text-[10px] font-bold text-white/80 uppercase tracking-widest mb-1">Verification Failed</p>
                                     <h4 class="text-base font-black tracking-tight text-white" x-text="statusMessage">Invalid QR code</h4>
                                 </div>
                                 <!-- Countdown / Resume Button -->
                                 <div class="pt-2">
                                     <button @click="resetScanState()" class="px-5 py-2.5 bg-white text-red-600 text-[10px] font-black rounded-xl uppercase tracking-widest hover:bg-white/95 transition shadow-lg">
                                         Dismiss (<span x-text="countdown">3</span>s)
                                     </button>
                                 </div>
                             </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-darkblue/5 rounded-xl">
                                <svg class="w-6 h-6 text-darkblue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Current Session</p>
                                <p class="text-sm font-black text-darkblue">
                                    @if($selectedCourseId && count($courses) > 0)
                                        @php
                                            $currentCourse = collect($courses)->firstWhere('id', $selectedCourseId);
                                        @endphp
                                        @if($currentCourse)
                                            {{ $currentCourse->course_code }} - {{ $currentCourse->course_name }}
                                        @else
                                            No Course Selected
                                        @endif
                                    @else
                                        No Course Selected
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button @click="openModal = true" class="px-6 py-3 bg-gold text-white text-xs font-black rounded-xl hover:bg-gold/90 transition uppercase tracking-widest shadow-lg shadow-gold/20">
                                Select Course
                            </button>
                            <button @click="let code = prompt('Enter Student Matric Number:'); if(code) { onScanSuccess(code); }" class="px-6 py-3 bg-darkblue text-white text-xs font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-lg shadow-darkblue/20">
                                Manual Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last Scanned Student Feedback -->
            <div class="bg-gold/10 border border-gold/20 rounded-2xl p-6 flex items-center justify-between transition-all duration-300"
                 x-show="scannedStudent !== null"
                 x-transition
                 style="display: none;">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full border-2 border-gold overflow-hidden bg-white flex items-center justify-center font-black text-gold" x-text="scannedStudent ? scannedStudent.initials : 'JD'">JD</div>
                    <div>
                        <p class="text-[10px] font-bold text-gold uppercase tracking-widest leading-none mb-1">Successfully Recorded</p>
                        <h4 class="text-base font-black text-darkblue" x-text="scannedStudent ? scannedStudent.name + ' (' + scannedStudent.matric_number + ')' : ''">John Doe (CS/2023/045)</h4>
                    </div>
                </div>
                <span class="text-[10px] font-bold py-1 px-3 rounded-full bg-gold text-white uppercase tracking-tighter">Just Now</span>
            </div>
        </div>

        <!-- Attendance Log Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                <div class="p-6 border-b border-stone-100 bg-stone-50/50">
                    <h3 class="text-sm font-black text-darkblue uppercase tracking-widest">Attendance Log</h3>
                </div>
                <div class="divide-y divide-stone-100 max-h-[350px] overflow-y-auto custom-scrollbar">
                    @forelse($attendanceLog as $log)
                        <div class="p-4 flex items-center justify-between hover:bg-stone-50 transition animate-in fade-in slide-in-from-top-2 duration-300">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-stone-100 flex items-center justify-center text-xs font-bold text-darkblue">{{ $log['index'] }}</div>
                                <div>
                                    <p class="text-xs font-bold text-stone-800">{{ $log['name'] }}</p>
                                    <p class="text-[10px] text-stone-500 uppercase tracking-tighter">{{ $log['time'] }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold text-green-600 uppercase">{{ $log['status'] }}</span>
                        </div>
                    @empty
                        <div class="p-8 text-center text-stone-400">
                            <svg class="w-8 h-8 mx-auto text-stone-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <p class="text-[10px] font-bold uppercase tracking-widest mb-1">No Records Yet</p>
                            <p class="text-[10px] text-stone-400">Scan student QR codes to start logging attendance.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Session Stats -->
            <div class="bg-darkblue rounded-2xl p-6 text-white shadow-xl shadow-darkblue/20">
                <p class="text-[10px] font-bold text-darkblue-light/70 uppercase tracking-widest mb-4">Session Statistics</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-2xl font-black text-gold">{{ $enrolledCount }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-tighter opacity-70">Enrolled</p>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white">{{ $markedCount }}</p>
                        <p class="text-[10px] font-bold uppercase tracking-tighter opacity-70">Marked</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Library & Initialization -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        /**
         * Generates a pleasant "success" chime using the Web Audio API.
         * This provides immediate audio feedback without needing external files.
         */
        function playSuccessSound() {
            try {
                const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioCtx.createOscillator();
                const gainNode = audioCtx.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioCtx.destination);

                oscillator.type = 'sine';
                const now = audioCtx.currentTime;
                
                // A pleasant two-tone ascending chime
                oscillator.frequency.setValueAtTime(880, now); // A5
                oscillator.frequency.exponentialRampToValueAtTime(1320, now + 0.1); // E6

                gainNode.gain.setValueAtTime(0.1, now);
                gainNode.gain.exponentialRampToValueAtTime(0.01, now + 0.4);

                oscillator.start(now);
                oscillator.stop(now + 0.4);
            } catch (e) {
                console.warn("Audio feedback not supported or blocked:", e);
            }
        }

        let isProcessing = false;
        let html5QrcodeScanner = null;

        /**
         * Initializes and starts the QR scanner only when requested by the user.
         */
        function startScanner() {
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader-target", 
                    { fps: 10, qrbox: {width: 220, height: 220} }, 
                    /* verbose= */ false
                );
            }
            html5QrcodeScanner.render(onScanSuccess);
        }

        function onScanSuccess(decodedText, decodedResult) {
            if (isProcessing) return;
            isProcessing = true;
            
            // Find alpine app instance
            const alpineEl = document.getElementById('attendance-tracker-container');
            if (!alpineEl) {
                isProcessing = false;
                return;
            }
            const alpineInstance = Alpine.$data(alpineEl);
            
            // Set loading feedback state
            alpineInstance.setScanState('processing', 'Recording attendance for student...');
            playSuccessSound();
            
            // Provide a quick visual flash on the scanner for extra feedback
            const reader = document.getElementById('reader');
            if (reader) {
                reader.style.borderColor = '#10b981'; // Success Green
                setTimeout(() => reader.style.borderColor = '', 500);
            }
            
            // Send to Livewire component backend
            @this.scanBarcode(decodedText).then(result => {
                if (result.status === 'success') {
                    alpineInstance.setScanState('success', result.message, result.student);
                } else if (result.status === 'duplicate') {
                    alpineInstance.setScanState('duplicate', result.message, result.student);
                } else {
                    alpineInstance.setScanState('error', result.message);
                }
            }).catch(err => {
                console.error("Scanning request failed:", err);
                alpineInstance.setScanState('error', "A connection error occurred. Please try again.");
            });
        }
    </script>

    <!-- Course Selection Modal -->
    <div x-show="openModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-darkblue/20 backdrop-blur-sm"
         style="display: none;"
         x-transition>
        <div @click.away="openModal = false" 
             class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden border border-stone-100 animate-in fade-in zoom-in-95 duration-200">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-black text-darkblue uppercase tracking-tight">Select Course</h3>
                    <button @click="openModal = false" class="text-stone-400 hover:text-stone-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-2">Available Courses</label>
                        <select wire:model.live="selectedCourseId" @change="openModal = false" class="w-full bg-stone-50 border-stone-200 rounded-xl py-3 px-4 text-sm font-bold text-darkblue focus:ring-2 focus:ring-darkblue/20 focus:border-darkblue transition-all outline-none">
                            <option value="">-- Choose a course --</option>
                            @foreach($courses as $c)
                                <option value="{{ $c->id }}">{{ $c->course_code }} - {{ $c->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button @click="openModal = false" class="w-full py-4 bg-darkblue text-white text-xs font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-xl shadow-darkblue/20">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

