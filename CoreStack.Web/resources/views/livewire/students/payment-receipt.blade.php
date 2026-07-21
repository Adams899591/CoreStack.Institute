<div class="max-w-6xl mx-auto space-y-6">
    <!-- Top Header (Centered School Logo and Name) -->
    <div class="bg-white rounded-xl shadow-sm border border-stone-200 p-6 flex flex-col items-center text-center">
        <div class="w-16 h-16 bg-darkblue rounded-full flex items-center justify-center shadow-sm mb-2 border-2 border-gold">
            <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
            </svg>
        </div>
        <h1 class="text-xl font-black text-darkblue tracking-tight uppercase">CoreStack Academy</h1>
        <p class="text-xs font-bold text-gold uppercase tracking-widest mt-0.5">Fee Breakdown & Verification Portal</p>
    </div>

    <!-- Main Grid Workspace -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- LEFT COLUMN: QR Verification & Student/Tenant Info -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-md border border-stone-200 p-6 space-y-6">
            
            <!-- QR Code Section -->
            <div class="flex flex-col items-center border-b border-stone-100 pb-6">
                <div class="bg-stone-50 p-4 rounded-xl border border-stone-200 shadow-inner flex items-center justify-center bg-white">
                    <!-- Simple QR Code Package Integration -->
                    {!! QrCode::size(140)->color(26, 43, 76)->generate($QrCodeUrl) !!}
                    {{-- {!! QrCode::size(140)->color(26, 43, 76)->generate(url()->current() . '?trx=' . $transaction_id) !!} --}}
                </div>

                @if (session()->has('remitterError'))
                    <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                        {{ session('remitterError') }}
                    </div>
                @endif

                <div class="w-full flex items-center justify-between mt-4 bg-stone-50 px-3 py-2 rounded-lg border border-stone-200">
                    <div class="text-left">
                        <h3 class="text-[10px] font-black text-darkblue uppercase tracking-wider">Receipt Remedial</h3>
                        <p class="text-xs font-bold text-gold font-mono mt-0.5">#REC-2026-9851</p>
                    </div>
                    <!-- Quick Download Link on the Left Panel -->
                        <button wire:click="DownloadRemiter" 
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-40 cursor-not-allowed"
                                class="p-2 text-stone-500 hover:text-darkblue hover:bg-stone-200/60 rounded-md transition" 
                                title="Download Receipt">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </button>
                </div>
            </div>

            <!-- Student / Tenant Information -->
            <div class="space-y-3 border-b border-stone-100 pb-6">
                <h4 class="text-[10px] font-black uppercase text-stone-400 tracking-widest">Student Information</h4>
                <div class="space-y-2">
                    <div>
                        <p class="text-[10px] text-stone-500 font-medium uppercase">Full Name</p>
                        <p class="text-xs font-bold text-stone-800">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-stone-500 font-medium uppercase">Email Address</p>
                        <p class="text-xs font-semibold text-stone-700">{{ Auth::user()->email ?? 'krista.littel@corestack.edu.ng' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-stone-500 font-medium uppercase">Phone Number</p>
                        <p class="text-xs font-semibold text-stone-700">{{Auth::user()->StudentProfile->phone}}</p>
                    </div>
                </div>
            </div>

            <!-- Payment Details -->
            <div class="space-y-3">
                <h4 class="text-[10px] font-black uppercase text-stone-400 tracking-widest">Payment Meta</h4>
                <div class="grid grid-cols-2 gap-2 bg-stone-50 p-3 rounded-lg border border-stone-200">
                    <div>
                        <p class="text-[9px] text-stone-500 font-medium uppercase">Channel</p>
                        <p class="text-xs font-bold text-darkblue">Online Gateway</p>
                    </div>
                    <div>
                        <p class="text-[9px] text-stone-500 font-medium uppercase">Status</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800 uppercase tracking-wide">
                            Paid
                        </span>
                    </div>
                    <div>
                        <p class="text-[9px] text-stone-500 font-medium uppercase">Payment ID</p>
                        <p class="text-xs font-semibold text-stone-700">{{ $paymentId ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] text-stone-500 font-medium uppercase">Transaction ID</p>
                        <p class="text-xs font-semibold text-stone-700">{{ $transactionId ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: Detailed Fee Matrix Breakdown -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-md border border-stone-200 overflow-hidden flex flex-col">
            <div class="bg-darkblue px-6 py-4 flex justify-between items-center">
                <span class="text-xs font-bold text-white uppercase tracking-wider">Breakdown Matrix</span>
                <span class="text-[10px] font-bold text-gold uppercase tracking-wider">Session: 2025/2026</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left border-collapse">
                    <thead class="bg-stone-100 text-stone-600 font-bold uppercase text-[10px] border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center">S/N</th>
                            <th class="px-6 py-3">Item Description</th>
                            <th class="px-6 py-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-200 text-stone-700">

                        {{-- this help too loop all the school fees breakdown --}}
                        @foreach ($breakdown as $item)
                           <tr><td class="px-6 py-3 text-center font-medium text-stone-400">{{$item["id"]}}</td><td class="px-6 py-3">{{$item["name"]}}</td><td class="px-6 py-3 text-right font-semibold">₦{{$item["amount"]}}</td></tr>  
                        @endforeach

                    </tbody>
                    <tfoot class="bg-stone-50 border-t-2 border-stone-200 font-bold text-darkblue">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right uppercase tracking-wider text-[10px]">Cumulative Total:</td>
                            <td class="px-6 py-4 text-right text-base font-black text-stone-900">₦{{$totalPayment}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Action Footer (Both Payment & Download Enabled) -->
            <div class="p-6 bg-stone-50 border-t border-stone-200 flex flex-col sm:flex-row justify-end items-center gap-3">
               
                @if (session()->has('breakdownError'))
                        <div class="w-full rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                            {{ session('breakdownError') }}
                        </div>
                @endif
               
                <button wire:click="DownloadBreakdown" 
                    wire:loading.attr="disabled" 
                    wire:loading.class="opacity-50 cursor-not-allowed" 
                    class="w-full sm:w-auto px-6 py-3 text-xs font-bold text-stone-700 bg-stone-200 hover:bg-stone-300 rounded-lg transition uppercase tracking-wider text-center">
                    <span wire:loading.remove>Download PDF</span>
                    <span wire:loading>Downloading...</span>
                </button> 
            </div>
        </div>

    </div>
</div>