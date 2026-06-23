

<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl shadow-sm border border-stone-200">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight">Registration Details</h1>
            <p class="text-xs font-medium text-stone-500 uppercase tracking-widest mt-1">CoreStack Academy • Continuous Assessment Record</p>
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="history.back()" class="inline-flex items-center px-4 py-2.5 bg-white text-stone-700 text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-stone-50 transition shadow-sm border border-stone-200 focus:outline-none print:hidden" wire:navigate>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </button>
            
            <button onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-darkblue text-gold text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-darkblue-light transition shadow-sm border border-gold/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print Results
            </button>
        </div>
    </div>

    {{-- Detailed Assessment Table Card --}}
    <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="bg-stone-50/50 px-6 py-4 border-b border-stone-200 flex flex-wrap items-center justify-between gap-2 rounded-t-xl">
            <div class="flex items-center space-x-4">
                <span class="bg-darkblue text-gold text-[10px] font-black px-2.5 py-1 rounded uppercase tracking-tighter">2023/2024 Session</span>
                <h2 class="text-sm font-bold text-stone-800 uppercase tracking-tight">100 Level - First Semester</h2>
            </div>
            <span class="text-[10px] font-bold text-stone-400 uppercase">Academic Summary Available</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 border-y border-l rounded-tl-lg text-xs font-semibold text-gray-600 uppercase tracking-wider">S/N</th>
                        <th class="px-4 py-3 border-y text-xs font-semibold text-gray-600 uppercase tracking-wider">Courses</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Credit</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">CA1</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">CA2</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">CA3</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">CA4</th>
                        <th class="px-4 py-3 border-y border-r rounded-tr-lg text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Exam</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- Row 1 --}}
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">1</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Introduction to Cyber Security</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-707 text-center bg-gray-50/30">3</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">15.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">18.5</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">55.0</td>
                    </tr>

                    {{-- Row 2 --}}
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">2</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Web Application Development</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-707 text-center bg-gray-50/30">4</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">12.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">0.0</td>
                    </tr>

                    {{-- Row 3 --}}
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">3</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Data Structures and Algorithms</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-707 text-center bg-gray-50/30">3</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">14.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">13.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">15.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">10.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">60.0</td>
                    </tr>

                    {{-- Row 4 --}}
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">4</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Cloud Computing Fundamentals</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-707 text-center bg-gray-50/30">3</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">0.0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>