<div>
    <div class="mb-6">
        <h1 class="text-2xl font-black tracking-tight text-stone-800 uppercase">Course Catalog</h1>
        <p class="text-sm text-stone-500">View and manage the academic outlines for various levels and semesters.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">S/N</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Outline</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Level</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Semester</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Courses</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    
                    @php
                        $SN = 1;  // used to declear SN number to start from 1
                    @endphp

                   <!-- 100 Level First Semester TO 500Level Secound Semester -->
                    @foreach ($courses as $course)  

                        <tr class="hover:bg-stone-50/50 transition-colors group">
                            <td class="px-6 py-4 text-sm font-medium text-stone-500">0{{$SN++}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">
                                {{$course->level}} Level {{$course->semester}} Semester
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-stone-100 text-stone-600 rounded-md uppercase">
                                    {{$course->level}} Level
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-stone-600 font-medium">{{$course->semester}}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    {{-- this section show the number of course for each levels --}}
                                    <span class="text-sm font-black text-stone-800">

                                        @if ($course->level == 100 && $course->semester === "First")
                                            {{$count["100_F"]}}
                                        @elseif($course->level == 100 && $course->semester === "Second")
                                            {{$count["100_S"]}}
                                        @elseif($course->level == 200 && $course->semester === "First")
                                            {{$count["200_F"]}}
                                        @elseif($course->level == 200 && $course->semester === "Second")
                                            {{$count["200_S"]}}
                                        @elseif($course->level == 300 && $course->semester === "First")
                                            {{$count["300_F"]}}
                                        @elseif($course->level == 300 && $course->semester === "Second")
                                            {{$count["300_S"]}}
                                        @elseif($course->level == 400 && $course->semester === "First")
                                            {{$count["400_F"]}}
                                        @elseif($course->level == 400 && $course->semester === "Second")
                                            {{$count["400_S"]}}
                                        @elseif($course->level == 500 && $course->semester === "First")
                                            {{$count["500_F"]}}
                                        @elseif($course->level == 500 && $course->semester === "Second")
                                            {{$count["500_S"]}}      
                                        @endif

                                    </span>
                                    <a href="{{ route('std.course-details', ["level" => $course->level, "semester" => $course->semester ]) }}" wire:navigate class="inline-flex items-center px-4 py-1.5 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm hover:shadow-md focus:outline-none">
                                        <span>View</span>
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
