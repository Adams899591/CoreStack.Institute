<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight uppercase">Payment History</h1>
            <p class="text-sm text-stone-500">Track and manage all your financial transactions with the Institute.</p>
        </div>
        <button class="flex items-center justify-center px-4 py-2 bg-darkblue text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-darkblue-light transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Download Statement
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm flex items-center space-x-4">
            <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Total Paid</p>
                <p class="text-xl font-black text-stone-800">₦{{$totalPayment}}</p>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm flex items-center space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Outstanding</p>
                <p class="text-xl font-black text-stone-800">₦{{$outStanding}}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm flex items-center space-x-4 md:col-span-2 lg:col-span-1">
            <div class="p-3 bg-darkblue text-gold rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Last Payment</p>
                <p class="text-xl font-black text-stone-800">{{$lastPayment->created_at->format("d F Y")}}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

         {{-- Search Section  --}}
        <div class="p-6 border-b border-stone-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="relative flex-1 max-w-sm">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search by Transaction ID..." class="w-full pl-10 pr-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
            </div>
            <div class="flex items-center space-x-3 text-sm">
                <select class="bg-stone-50 border border-stone-200 rounded-lg px-3 py-2 text-stone-600 focus:outline-none focus:border-gold transition">
                    <option>All Sessions</option>
                    <option>2023/2024 Session</option>
                    <option>2022/2023 Session</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">

                {{-- table header --}}
                <thead>
                    <tr class="bg-stone-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Date</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Refrence ID</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Description</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest">Amount</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase tracking-widest text-right">Action</th>
                    </tr>
                </thead>

                 {{-- table body --}}
                <tbody class="divide-y divide-stone-100">

                    @foreach ($payments as $payment) 
                        <tr class="hover:bg-stone-50/50 transition">
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-stone-700">{{$payment->created_at->format("F j, Y")}}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono text-stone-500">{{$payment->reference_no}}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-stone-800 leading-tight">{{ ((($payments->currentPage() - 1) * $payments->perPage()) + $loop->iteration) * 100 }} Tuition Fee</p>
                                <p class="text-[10px] text-stone-400 uppercase font-semibold mt-0.5">{{$payment->session}} Session • 1st & 2nd Semester</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-stone-800">₦{{$payment->amount_paid}}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-2 py-1 text-[9px] font-bold uppercase tracking-tighter bg-green-100 text-green-700 rounded-md">Successful</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-darkblue hover:text-gold transition font-bold text-[10px] uppercase tracking-widest">View Receipt</button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        
        <div class="px-6 py-4 bg-stone-50/30 border-t border-stone-100 flex items-center justify-between">
            {{$payments->links()}}
        </div>

    </div>
</div>