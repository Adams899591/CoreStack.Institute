{{-- 
    ACADEMIC CALCULATION LOGIC (5.00 SCALE)
    ---------------------------------------
    1. GRADING SYSTEM:
       - 70 - 100: A (Grade Point = 5)
       - 60 - 69 : B (Grade Point = 4)
       - 50 - 59 : C (Grade Point = 3)
       - 45 - 49 : D (Grade Point = 2)
       - 40 - 44 : E (Grade Point = 1)
       - 00 - 39 : F (Grade Point = 0)

    2. DEFINITIONS:
       - CU (Credit Unit): The weight of the course (e.g., 3 units).
       - GP (Grade Point): Based on the score (e.g., A = 5).
       - TGP (Total Grade Point): CU * GP.
       - CCR (Credit Units Registered): Sum of all units taken in a semester.
       - CCE (Credit Units Earned): Sum of units where student passed (A to E).

    3. SEMESTER GPA CALCULATION:
       Example Semester 1:
       - CSC 101 (3 units): Score 75 -> A -> GP 5. TGP = 3 * 5 = 15
       - MTH 101 (3 units): Score 62 -> B -> GP 4. TGP = 3 * 4 = 12
       - GST 101 (2 units): Score 71 -> A -> GP 5. TGP = 2 * 5 = 10
       
       Semester TGP Sum = 15 + 12 + 10 = 37
       Semester Units Sum (CCR) = 3 + 3 + 2 = 8
       GPA = 37 / 8 = 4.63

    4. CUMULATIVE GPA (CGPA) CALCULATION:
       CGPA = (Sum of TGPs from ALL Semesters) / (Sum of Credit Units from ALL Semesters)
       
       This ensures that the weight of every course is carried over. Because the max 
       GP is 5.0, the result will naturally stay between 0.00 and 5.00.
--}}

<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-stone-200">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight">Academic Transcript</h1>
            <p class="text-xs font-medium text-stone-500 uppercase tracking-widest mt-1">CoreStack Academy • Official Record</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-darkblue text-gold text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-darkblue-light transition shadow-sm border border-gold/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print Results
            </button>
        </div>
    </div>

    {{-- Transcript Content - Grouped by Session/Level --}}
    <div class="space-y-8 print:space-y-4">
        {{-- Example Block: 100 Level --}}
        <section class="bg-white border border-stone-200 rounded-xl shadow-sm overflow-hidden">
            <div class="bg-stone-50/50 px-6 py-4 border-b border-stone-200 flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center space-x-4">
                    <span class="bg-darkblue text-gold text-[10px] font-black px-2.5 py-1 rounded uppercase tracking-tighter">2023/2024 Session</span>
                    <h2 class="text-sm font-bold text-stone-800 uppercase tracking-tight">100 Level - First Semester</h2>
                </div>
                <span class="text-[10px] font-bold text-stone-400 uppercase">Academic Summary Available</span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-white">
                            <th class="px-6 py-3 text-left text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">Course Code</th>
                            <th class="px-6 py-3 text-left text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">Course Title</th>
                            <th class="px-6 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">Unit</th>
                            <th class="px-6 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">Grade</th>
                            <th class="px-6 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">GP</th>
                            <th class="px-6 py-3 text-center text-[10px] font-bold text-stone-500 uppercase tracking-widest border-b border-stone-100">TGP</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        {{-- These would be dynamic in a real app --}}
                        <tr class="hover:bg-stone-50/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-stone-800">CSC 101</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-stone-600">Introduction to Computer Science</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-medium">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-black text-darkblue">A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center">5.0</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-bold text-stone-900">15.0</td>
                        </tr>
                        <tr class="hover:bg-stone-50/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-stone-800">MTH 101</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-stone-600">Algebra and Trigonometry</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-medium">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-black text-darkblue">B</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center">4.0</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-bold text-stone-900">12.0</td>
                        </tr>
                        <tr class="hover:bg-stone-50/30 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-bold text-stone-800">GST 101</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-stone-600">Use of English & Communication Skills</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-medium">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-black text-darkblue">A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center">5.0</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-center font-bold text-stone-900">10.0</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Semester Summary Statistics --}}
            <div class="bg-stone-50/30 border-t border-stone-100 p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                    <div class="bg-white p-3 rounded-lg border border-stone-200/60 shadow-sm">
                        <p class="text-[9px] font-black text-stone-400 uppercase tracking-widest">Semester CCR</p>
                        <p class="text-lg font-black text-stone-800 mt-1">8</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-stone-200/60 shadow-sm">
                        <p class="text-[9px] font-black text-stone-400 uppercase tracking-widest">Semester CCE</p>
                        <p class="text-lg font-black text-stone-800 mt-1">8</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-stone-200/60 shadow-sm">
                        <p class="text-[9px] font-black text-stone-400 uppercase tracking-widest">Semester TGP</p>
                        <p class="text-lg font-black text-stone-800 mt-1">37.0</p>
                    </div>
                    <div class="bg-white p-3 rounded-lg border border-stone-200/60 shadow-sm">
                        <p class="text-[9px] font-black text-darkblue uppercase tracking-widest">Semester GPA</p>
                        <p class="text-lg font-black text-darkblue mt-1">4.63</p>
                    </div>
                    {{-- Cumulative Column --}}
                    <div class="bg-khaki/5 p-3 rounded-lg border border-gold/20 shadow-sm md:col-span-2 lg:col-span-1">
                        <p class="text-[9px] font-black text-gold uppercase tracking-widest">Cumulative GPA</p>
                        <p class="text-lg font-black text-stone-900 mt-1">4.63</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Empty State or Message for No Results --}}
        <div class="py-12 flex flex-col items-center justify-center bg-white rounded-xl border-2 border-dashed border-stone-200 opacity-60">
            <svg class="w-12 h-12 text-stone-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <p class="text-sm font-bold text-stone-400 uppercase tracking-tighter">Subsequent levels will appear here upon result publication</p>
        </div>
    </div>

    {{-- Print Footer (Hidden on screen) --}}
    <div class="hidden print:block mt-12 pt-8 border-t-2 border-stone-800">
        <div class="flex justify-between items-end">
            <div class="text-[10px] text-stone-600">
                <p>This is a computer-generated document.</p>
                <p>Date Generated: {{ now()->format('d/m/Y H:i:s') }}</p>
            </div>
            <div class="w-48 border-t border-stone-400 pt-2 text-center">
                <p class="text-[10px] font-bold uppercase">Registrar's Signature</p>
            </div>
        </div>
    </div>
</div>
