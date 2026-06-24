<div class="max-w-6xl mx-auto space-y-6">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-stone-200">
        <div>
            <h2 class="text-2xl font-bold text-[#1A2B4C]">Senate Approved Results</h2>
            <p class="text-sm text-stone-500 mt-1">Official summary of your academic performance per semester</p>
        </div>
        <button class="bg-[#1A2B4C] hover:bg-[#2A3B5C] text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm flex items-center justify-center w-full md:w-auto focus:outline-none">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Print Summary
        </button> 
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">

                {{-- Table Header --}}
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200">
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">S/N</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Session</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider">Level</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Total Credit Registered">TCR</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Total Credit Earned">TCE</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Total Grade Points">TGP</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Last Cumulative Grade Point Average">LCGPA</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Grade Point Average">GPA</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider" title="Cumulative Grade Point Average">CGPA</th>
                        <th class="px-6 py-4 text-xs font-bold text-[#1A2B4C] uppercase tracking-wider text-right">Action</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-stone-200">
                    
                   @php
                       $SN = 1;
                   @endphp


                    @foreach ($semesterResults as $semesterResult)
                         
                        <tr class="hover:bg-stone-50/80 transition">
                            <td class="px-6 py-4 text-sm font-semibold text-stone-800">{{$SN++}}</td>
                            <td class="px-6 py-4 text-sm font-medium text-stone-800">{{$semesterResult->session}}</td>
                            <td class="px-6 py-4 text-sm text-stone-600">{{$semesterResult->level}}</td>
                            <td class="px-6 py-4 text-sm text-stone-600">{{$semesterResult->total_units_registered}}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-stone-800">{{$semesterResult->total_units_registered}}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-stone-800">{{$semesterResult->total_units_passed}}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-stone-800">{{$semesterResult->total_tgp}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C]">{{$semesterResult->last_cumulative_cgpa}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#D4AF37]">{{$semesterResult->grade_point_average_gpa}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C]">{{$semesterResult->cumulative_cgpa}}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{route("std.student-transcript-details", ["semester" => $semesterResult->semester, "level" => $semesterResult->level, "session" => $semesterResult->session])}}" class="inline-flex items-center px-4 py-1.5 bg-[#F0E68C]/30 text-[#B8860B] border border-[#D4AF37]/50 hover:bg-[#D4AF37] hover:text-white hover:border-[#D4AF37] rounded-md text-xs font-bold transition shadow-sm focus:outline-none" wire:navigate>
                                    View
                                    <svg class="w-3 h-3 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="bg-stone-50 p-5 border-t border-stone-200 flex flex-col md:flex-row items-center justify-between">
            <span class="text-sm font-medium text-stone-500 mb-2 md:mb-0">Showing 2 records</span>
            <div class="flex items-center space-x-6 text-sm text-stone-800 bg-white px-4 py-2 rounded-lg border border-stone-200 shadow-sm">
                <div>
                    Degree Class: <span class="font-bold text-[#B8860B] ml-1 uppercase">First Class</span>
                </div>
                <div class="h-4 w-px bg-stone-300"></div>
                <div>
                    Current CGPA: <span class="font-black text-lg text-[#1A2B4C] ml-1">4.70</span>
                </div>
            </div>
        </div>
    </div>
</div>