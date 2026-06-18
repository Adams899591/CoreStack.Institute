<div x-data="{ openModal: false, scannerActive: false }">
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
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold text-stone-500 uppercase">Camera Active</span>
                    </div>
                </div>
                <div class="p-8">
                    <p>Success matric number CSc/202431714</p>
                    <!-- Scanner Container -->
                    <div id="reader" class="w-full rounded-xl overflow-hidden border-2 border-dashed border-stone-200 bg-stone-50 aspect-video flex items-center justify-center relative">
                        <div x-show="!scannerActive" class="text-center p-4">
                            <svg class="w-12 h-12 mx-auto text-stone-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v-4m6 0h-2m-6 0H4m0 6V4m16 6V4m0 16v-4m-16 0v4m0-16h2m12 0h2M4 12h2m12 0h2m-6 0h-2"></path>
                            </svg>
                            <p class="text-xs font-bold text-stone-400 uppercase tracking-tighter mb-4">Scanner is currently idle</p>
                            <button @click="scannerActive = true; startScanner()" class="px-6 py-3 bg-darkblue text-white text-[10px] font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-lg shadow-darkblue/20">
                                Launch Camera
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-darkblue/5 rounded-xl">
                                <svg class="w-6 h-6 text-darkblue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Current Session</p>
                                <p class="text-sm font-black text-darkblue">CSC 301 - Data Structures</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button @click="openModal = true" class="px-6 py-3 bg-gold text-white text-xs font-black rounded-xl hover:bg-gold/90 transition uppercase tracking-widest shadow-lg shadow-gold/20">
                                Select Course
                            </button>
                            <button class="px-6 py-3 bg-darkblue text-white text-xs font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-lg shadow-darkblue/20">
                                Manual Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last Scanned Student Feedback -->
            <div class="bg-gold/10 border border-gold/20 rounded-2xl p-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full border-2 border-gold overflow-hidden bg-white flex items-center justify-center font-black text-gold">JD</div>
                    <div>
                        <p class="text-[10px] font-bold text-gold uppercase tracking-widest leading-none mb-1">Successfully Recorded</p>
                        <h4 class="text-base font-black text-darkblue">John Doe (CS/2023/045)</h4>
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
                <div class="divide-y divide-stone-100">
                    <!-- Static Entry 1 -->
                    <div class="p-4 flex items-center justify-between hover:bg-stone-50 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-stone-100 flex items-center justify-center text-xs font-bold text-darkblue">01</div>
                            <div>
                                <p class="text-xs font-bold text-stone-800">Alice Smith</p>
                                <p class="text-[10px] text-stone-500 uppercase tracking-tighter">10:05 AM</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-green-600 uppercase">Present</span>
                    </div>
                    <!-- Static Entry 2 -->
                    <div class="p-4 flex items-center justify-between hover:bg-stone-50 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-stone-100 flex items-center justify-center text-xs font-bold text-darkblue">02</div>
                            <div>
                                <p class="text-xs font-bold text-stone-800">Bob Johnson</p>
                                <p class="text-[10px] text-stone-500 uppercase tracking-tighter">10:08 AM</p>
                            </div>
                        </div>
                        <span class="text-[10px] font-bold text-green-600 uppercase">Present</span>
                    </div>
                </div>
            </div>

            <!-- Session Stats -->
            <div class="bg-darkblue rounded-2xl p-6 text-white shadow-xl shadow-darkblue/20">
                <p class="text-[10px] font-bold text-darkblue-light/70 uppercase tracking-widest mb-4">Session Statistics</p>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-2xl font-black text-gold">45</p>
                        <p class="text-[10px] font-bold uppercase tracking-tighter opacity-70">Enrolled</p>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white">28</p>
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

        let html5QrcodeScanner = null;

        /**
         * Initializes and starts the QR scanner only when requested by the user.
         */
        function startScanner() {
            if (!html5QrcodeScanner) {
                html5QrcodeScanner = new Html5QrcodeScanner(
                    "reader", 
                    { fps: 10, qrbox: {width: 250, height: 250} }, 
                    /* verbose= */ false
                );
            }
            html5QrcodeScanner.render(onScanSuccess);
        }

        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            playSuccessSound();
            
            // Provide a quick visual flash on the scanner for extra feedback
            const reader = document.getElementById('reader');
            reader.style.borderColor = '#10b981'; // Success Green
            setTimeout(() => reader.style.borderColor = '', 500);
        }
    </script>

    <!-- Course Selection Modal -->
    <div x-show="openModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-darkblue/20 backdrop-blur-sm"
         style="display: none;"
         x-transition>
        <div @click.away="openModal = false" 
             class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden border border-stone-100">
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
                        <select class="w-full bg-stone-50 border-stone-200 rounded-xl py-3 px-4 text-sm font-bold text-darkblue focus:ring-2 focus:ring-darkblue/20 focus:border-darkblue transition-all outline-none">
                            <option value="">-- Choose a course --</option>
                            <option value="1">CSC 301 - Data Structures</option>
                            <option value="2">CSC 302 - Algorithms</option>
                            <option value="3">CSC 305 - Database Systems</option>
                        </select>
                    </div>

                    <button @click="openModal = false" class="w-full py-4 bg-darkblue text-white text-xs font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-xl shadow-darkblue/20">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
