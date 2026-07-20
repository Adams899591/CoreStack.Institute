<div class="space-y-6">
    {{-- Page Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-stone-800">Grade Entry</h1>
            <p class="text-sm text-stone-500">Academic Session: 2023/2024 | First Semester</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-white border border-stone-200 text-stone-600 rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-stone-50 transition">
                Save Progress
            </button>
            <button class="px-4 py-2 bg-darkblue text-gold rounded-lg font-bold text-xs uppercase tracking-widest hover:bg-opacity-90 transition shadow-lg shadow-darkblue/20">
                Submit Final Grades
            </button>
        </div>
    </div>



    {{-- Flash Message Feedback --}}
    @if (session()->has('searchError'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 rounded-xl border border-red-200">
            {{ session('searchError') }}
        </div>
    @endif


    {{-- Selection & Filter Bar --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-[10px] font-black text-stone-400 uppercase tracking-[0.2em] mb-2">Selected Course</label>
            <select id="course-select" wire:change="SelectedCourseId($event.target.value)" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 focus:ring-2 focus:ring-gold/20 focus:border-gold outline-none transition cursor-pointer">
               <option value="">-- Choose a Course --</option>
                @foreach ($courses as $course)
                   <option value="{{ $course->id }}">{{ $course->course_code }}: {{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-black text-stone-400 uppercase tracking-[0.2em] mb-2">Student Group</label>
            <select class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 focus:ring-2 focus:ring-gold/20 focus:border-gold outline-none transition cursor-pointer">
                <option>All Students</option>
                <option>Section A (Morning)</option>
                <option>Section B (Afternoon)</option>
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-black text-stone-400 uppercase tracking-[0.2em] mb-2">Search Student</label>
            <form wire:submit="searchStudents()" class="relative w-full">
                <input type="text" wire:model.defer="searchQuery" placeholder="Matric No or Name..." wire:loading.attr="disabled" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 pr-12 text-sm text-stone-700 focus:ring-2 focus:ring-gold/20 focus:border-gold outline-none transition disabled:opacity-50 disabled:cursor-not-allowed">
                <button type="submit" wire:loading.attr="disabled" class="absolute right-3 top-2.5 text-stone-400 hover:text-emerald-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" title="Search">
                    <svg wire:loading.remove wire:target="searchStudents" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <svg wire:loading wire:target="searchStudents" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Flash Message Feedback --}}
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-200">
            {{ session('message') }}
        </div>
    @endif

    {{-- Grade Entry Table --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-4 bg-stone-50/50 border-b border-stone-100 flex items-center justify-between">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-widest">
                Enrolled Students ({{ count($resultsWithStudents) }})
            </span>
            <div class="flex items-center space-x-2 text-[10px] font-bold text-gold bg-gold/5 px-3 py-1 rounded-full">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"></path></svg>
                <span>Bulk Import via CSV</span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                {{-- Table Header --}}
                <thead>
                    <tr class="text-[10px] font-black text-stone-400 uppercase tracking-widest border-b border-stone-100 whitespace-nowrap">
                        <th class="px-6 py-4">Student Information</th>
                        <th class="px-6 py-4">CA 1 (10%)</th>
                        <th class="px-6 py-4">CA 2 (10%)</th>
                        <th class="px-6 py-4">CA 3 (10%)</th>
                        <th class="px-6 py-4">CA 4 (10%)</th>
                        <th class="px-6 py-4">Exam (60%)</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Grade</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-stone-50 whitespace-nowrap">
                    @forelse($resultsWithStudents as $index => $resultsWithStudent)
                        <tr class="hover:bg-stone-50/50 transition-colors group" wire:key="row-{{ $resultsWithStudent['id'] }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 rounded-full bg-stone-100 border-2 border-white shadow-sm flex items-center justify-center text-xs font-black text-darkblue uppercase">
                                        {{ substr($resultsWithStudent['user']['name'] ?? 'S', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-bold text-stone-800 leading-tight">
                                            {{ $resultsWithStudent['user']['name'] ?? 'N/A' }}
                                        </p>
                                        <p class="text-[10px] font-medium text-stone-400">
                                            {{ $resultsWithStudent['user']['student_profile']['matric_number'] ?? 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <input wire:model.defer="resultsWithStudents.{{ $index }}.grade_1" type="number" max="10" min="0" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                                @error("resultsWithStudents.{$index}.grade_1") <span class="block text-[10px] text-red-500">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-4">
                                <input wire:model.defer="resultsWithStudents.{{ $index }}.grade_2" type="number" max="10" min="0" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                                @error("resultsWithStudents.{$index}.grade_2") <span class="block text-[10px] text-red-500">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-4">
                                <input wire:model.defer="resultsWithStudents.{{ $index }}.grade_3" type="number" max="10" min="0" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                                @error("resultsWithStudents.{$index}.grade_3") <span class="block text-[10px] text-red-500">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-4">
                                <input wire:model.defer="resultsWithStudents.{{ $index }}.grade_4" type="number" max="10" min="0" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                                @error("resultsWithStudents.{$index}.grade_4") <span class="block text-[10px] text-red-500">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-4">
                                <input wire:model.defer="resultsWithStudents.{{ $index }}.exam_score" type="number" max="60" min="0" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                                @error("resultsWithStudents.{$index}.exam_score") <span class="block text-[10px] text-red-500">{{ $message }}</span> @enderror
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-black text-darkblue">
                                    {{ $resultsWithStudent['total_score'] ?? '----' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if (!empty($resultsWithStudent['grade']))
                                   <span class="px-2.5 py-1 rounded-md bg-stone-900 text-white text-[13px] font-black uppercase tracking-tighter">
                                       {{ $resultsWithStudent['grade'] }}
                                   </span>
                                @else   
                                  <span class="px-2.5 py-1 rounded-md bg-stone-100 text-stone-400 text-[10px] font-black uppercase tracking-tighter">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button type="button" wire:click="saveGrade({{ $index }})" wire:loading.attr="disabled" wire:target="saveGrade({{ $index }})" class="text-stone-400 hover:text-emerald-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" title="Save Row">
                                    <svg wire:loading.remove wire:target="saveGrade({{ $index }})" class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                    <svg wire:loading wire:target="saveGrade({{ $index }})" class="w-5 h-5 mx-auto animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-sm font-medium text-stone-400">
                                Please select a course to view enrolled students.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination/Footer bar --}}
        {{-- <div class="p-6 bg-stone-50/30 flex items-center justify-between border-t border-stone-100">
            <p class="text-xs text-stone-400 font-medium">Changes are saved individually per student record row.</p>
            <div class="flex space-x-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-darkblue text-gold font-bold text-xs">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div> --}}
    </div>
</div>