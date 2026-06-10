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

    {{-- Selection & Filter Bar --}}
    <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-[10px] font-black text-stone-400 uppercase tracking-[0.2em] mb-2">Selected Course</label>
            <select class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 focus:ring-2 focus:ring-gold/20 focus:border-gold outline-none transition cursor-pointer">
                <option>CSC 301: Algorithms & Data Structures</option>
                <option>CSC 405: Cyber Ethics</option>
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
            <div class="relative">
                <input type="text" placeholder="Matric No or Name..." class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-2.5 text-sm text-stone-700 focus:ring-2 focus:ring-gold/20 focus:border-gold outline-none transition">
                <svg class="w-4 h-4 text-stone-400 absolute right-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>

    {{-- Grade Entry Table --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-4 bg-stone-50/50 border-b border-stone-100 flex items-center justify-between">
            <span class="text-xs font-bold text-stone-500 uppercase tracking-widest">Enrolled Students (45)</span>
            <div class="flex items-center space-x-2 text-[10px] font-bold text-gold bg-gold/5 px-3 py-1 rounded-full">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"></path></svg>
                <span>Bulk Import via CSV</span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-stone-400 uppercase tracking-widest border-b border-stone-100">
                        <th class="px-6 py-4">Student Information</th>
                        <th class="px-6 py-4">CA 1 (15%)</th> {{-- Continuous Assessment 1 --}}
                        <th class="px-6 py-4">CA 2 (15%)</th> {{-- Continuous Assessment 2 --}}
                        <th class="px-6 py-4">CA 3 (10%)</th> {{-- Continuous Assessment 3 --}}
                        <th class="px-6 py-4">CA 4 (10%)</th> {{-- Continuous Assessment 4 --}}
                        <th class="px-6 py-4">Exam (50%)</th> {{-- Examination --}}
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Grade</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-50">
                    {{-- Mock Student Row --}}
                    @for ($i = 1; $i <= 5; $i++)
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-9 h-9 rounded-full bg-stone-100 border-2 border-white shadow-sm flex items-center justify-center text-xs font-black text-darkblue uppercase">
                                    {{ substr("Student Name", 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-stone-800 leading-tight">Student Name {{ $i }}</p>
                                    <p class="text-[10px] font-medium text-stone-400">CS/2023/00{{ $i }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" placeholder="50" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" placeholder="0" class="w-16 bg-stone-50 border border-stone-200 rounded-lg px-2 py-1.5 text-sm font-bold text-center text-stone-700 focus:border-gold outline-none transition">
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-black text-darkblue">--</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-md bg-stone-100 text-stone-400 text-[10px] font-black uppercase tracking-tighter">N/A</span>
                        </td>
                        <td class="px-6 py-4 text-right flex items-center justify-end space-x-2">
                            <button class="text-stone-400 hover:text-emerald-600 transition-colors" title="Save Row">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="p-6 bg-stone-50/30 flex items-center justify-between border-t border-stone-100">
            <p class="text-xs text-stone-400 font-medium">Auto-save active: Last saved 2 mins ago</p>
            <div class="flex space-x-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-darkblue text-gold font-bold text-xs">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-stone-200 text-stone-400 hover:bg-white hover:text-gold transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
            </div>
        </div>
    </div>
</div>
