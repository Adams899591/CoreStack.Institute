<div class="max-w-6xl mx-auto space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-stone-200">
        <div>
            <h2 class="text-2xl font-bold text-[#1A2B4C]">Course Registration History</h2>
            <p class="text-sm text-stone-500 mt-1">Review and manage your registered courses from previous semesters</p>
        </div>
        <button onclick="window.print()" class="bg-[#1A2B4C] hover:bg-[#2A3B5C] text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm flex items-center justify-center w-full md:w-auto focus:outline-none print:hidden">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Print History Slip
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">

                {{-- Table header --}}
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200">
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">S/N</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Session</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Level</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Remarks</th>
                        {{-- <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Total Credits</th> --}}
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider text-right">Action</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-stone-200">

                    @php
                        $SN = 1
                    @endphp
                    
                    @foreach ($results as $result)                     
                   
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="px-6 py-4 text-sm font-medium text-stone-800">{{$SN++}}</td>
                            <td class="px-6 py-4 text-sm font-medium text-stone-800">{{$result->session}}</td>
                            <td class="px-6 py-4 text-sm text-stone-600">{{$result->semester}} Semester</td>
                            <td class="px-6 py-4 text-sm text-stone-600">{{$result->level}} Level</td>
                            <td class="px-6 py-4 text-sm font-semibold text-stone-800">✔</td>
                            {{-- <td class="px-6 py-4 text-sm font-semibold text-stone-800">13 Units</td> --}}
                            <td class="px-6 py-4 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                    Approved
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{route("std.previous-registration-details", ["semester" => $result->semester, "level" => $result->level, "session" => $result->session])}}" class="inline-flex items-center px-4 py-1.5 bg-[#F0E68C]/30 text-[#B8860B] border border-[#D4AF37]/50 hover:bg-[#D4AF37] hover:text-white hover:border-[#D4AF37] rounded-md text-xs font-bold transition shadow-sm focus:outline-none" wire:navigate>
                                    View Details
                                    <svg class="w-3 h-3 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>
        
        <div class="bg-stone-50 p-5 border-t border-stone-200 flex flex-col md:flex-row items-center justify-between">
            <span class="text-sm font-medium text-stone-500 mb-2 md:mb-0">Showing semester records</span>
            <div class="flex items-center space-x-6 text-sm text-stone-800 bg-white px-4 py-2 rounded-lg border border-stone-200 shadow-sm">
                <div>
                    Total Registered Semesters: <span class="font-bold text-[#1A2B4C] ml-1">{{$totalSemesterReg}}</span>
                </div>
                <div class="h-4 w-px bg-stone-300"></div>
                <div>
                    Senate Approver <span class="font-black text-base text-[#B8860B] ml-1">✔</span>
                </div>
            </div>
        </div>
    </div>
</div>