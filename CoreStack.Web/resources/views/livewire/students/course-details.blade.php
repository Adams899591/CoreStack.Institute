<div>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black tracking-tight text-stone-800 uppercase">Course Details</h1>
            <p class="text-sm text-stone-500">List of registered courses for {{$level}} Level - {{$semester}} Semester.</p>
        </div>
        <a href="{{ route('std.course-catolog') }}" class="inline-flex items-center px-4 py-2 bg-stone-800 hover:bg-stone-900 text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm focus:outline-none w-fit"  wire:navigate>
            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Catalog
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200">
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">S/N</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Code</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Course Title</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400 text-center">Units</th>
                        <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-stone-400">Category</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    
                    @php
                        $SN = 1; // used to declear SN number to start from 1 
                    @endphp

                   <!-- Static Row 1 -->
                   @foreach ($courses as $course)
                        <tr class="hover:bg-stone-50/50 transition-colors group">
                            <td class="px-6 py-4 text-sm font-medium text-stone-500">0{{$SN++}}</td>
                            <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">{{$course->course_code}}</td>
                            <td class="px-6 py-4 text-sm text-stone-600 font-medium">{{$course->course_name}}</td>
                            <td class="px-6 py-4 text-sm text-stone-600 font-black text-center">{{$course->units}}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-blue-50 text-blue-600 rounded-md uppercase border border-blue-100">
                                    Core
                                </span>
                            </td>
                        </tr>
                   @endforeach

                </tbody>
                <tfoot>
                    <tr class="bg-stone-50/80">
                        <td colspan="3" class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-stone-400">Total Units:</td>
                        <td class="px-6 py-4 text-sm font-black text-[#1A2B4C] text-center">{{$totalCreditUnit}}.0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        <button type="button" class="px-6 py-3 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all shadow-md hover:shadow-lg focus:outline-none flex items-center">
            <span>Print Course List</span>
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
        </button>
    </div>
</div>
