<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight uppercase">Current Session Fee</h1>
            <p class="text-sm text-stone-500">Review your current academic session financial obligations.</p>
        </div>
        <div class="flex items-center space-x-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-lg text-xs font-bold uppercase tracking-wider border border-amber-200 shadow-sm">
            <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
            <span>Payment Pending</span>
        </div>
    </div>

    <!-- Session Info Card -->
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-darkblue text-gold rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest text-left">Academic Year</p>
                <p class="text-lg font-black text-stone-800">2023/2024 Session</p>
            </div>
        </div>
        
        <div class="hidden md:block h-10 w-[1px] bg-stone-100"></div>

        <div class="text-center md:text-left">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Current Level</p>
            <p class="text-lg font-black text-stone-800 uppercase">300 Level</p>
        </div>

        <div class="hidden md:block h-10 w-[1px] bg-stone-100"></div>

        <div class="text-center md:text-left">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Matric Number</p>
            <p class="text-lg font-black text-stone-800 uppercase">CSE/2024/31714300</p>
        </div>
    </div>

    <!-- Fee Breakdown Table -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex items-center justify-between">
            <h2 class="text-xs font-bold text-stone-400 uppercase tracking-widest">Fee Breakdown</h2>
            <button class="text-darkblue hover:text-gold transition text-[10px] font-bold uppercase tracking-widest">Print Invoice</button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Description</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Category</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <tr class="hover:bg-stone-50/30 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-stone-800 leading-tight text-left">Tuition Fee</p>
                            <p class="text-[10px] text-stone-400 uppercase font-semibold mt-0.5 text-left">Mandatory Academic Charge</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-stone-500 uppercase font-bold tracking-tight">Academic</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-black text-stone-800">₦150,000.00</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-stone-50/30 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-stone-800 leading-tight text-left">ICT & Library Maintenance</p>
                            <p class="text-[10px] text-stone-400 uppercase font-semibold mt-0.5 text-left">Technological Services</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-stone-500 uppercase font-bold tracking-tight">Utility</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-black text-stone-800">₦45,000.00</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-stone-50/30 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-stone-800 leading-tight text-left">Student Union Dues</p>
                            <p class="text-[10px] text-stone-400 uppercase font-semibold mt-0.5 text-left">Association Fees</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-stone-500 uppercase font-bold tracking-tight">Social</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-black text-stone-800">₦15,000.00</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Summary Footer -->
        <div class="p-6 bg-stone-50/30 border-t border-stone-100 flex flex-col items-end space-y-3">
            <div class="flex justify-between w-full max-w-xs text-sm">
                <span class="text-stone-500 font-medium">Sub-Total:</span>
                <span class="font-bold text-stone-800">₦210,000.00</span>
            </div>
            <div class="flex justify-between w-full max-w-xs pt-3 border-t border-stone-200">
                <span class="text-xs font-bold text-stone-400 uppercase tracking-widest">Total Due:</span>
                <span class="text-xl font-black text-darkblue">₦210,000.00</span>
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-4">
        <button class="px-8 py-3 bg-darkblue text-gold text-xs font-black uppercase tracking-widest rounded-xl hover:bg-darkblue-light transition shadow-lg flex items-center">
            Proceed to Payment
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </button>
    </div>
</div>
