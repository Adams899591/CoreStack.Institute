<div>
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
                    <!-- Scanner Container -->
                    <div id="reader" class="w-full rounded-xl overflow-hidden border-2 border-dashed border-stone-200 bg-stone-50 aspect-video flex items-center justify-center relative">
                        <div class="text-center p-4">
                            <svg class="w-12 h-12 mx-auto text-stone-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v-4m6 0h-2m-6 0H4m0 6V4m16 6V4m0 16v-4m-16 0v4m0-16h2m12 0h2M4 12h2m12 0h2m-6 0h-2"></path>
                            </svg>
                            <p class="text-xs font-bold text-stone-400 uppercase tracking-tighter">Initializing Camera Access...</p>
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
                        <button class="px-6 py-3 bg-darkblue text-white text-xs font-black rounded-xl hover:bg-darkblue-light transition uppercase tracking-widest shadow-lg shadow-darkblue/20">
                            Manual Entry
                        </button>
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
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            alert("Attendance Recorded for ID: " + decodedText);
        }
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
        html5QrcodeScanner.render(onScanSuccess);
    </script>
</div>
