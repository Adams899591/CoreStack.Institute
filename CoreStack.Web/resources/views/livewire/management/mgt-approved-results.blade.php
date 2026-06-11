<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight uppercase">Approved Results</h1>
            <p class="text-sm text-stone-500 font-medium">Review and manage results verified by the academic board.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-darkblue text-gold rounded-lg text-sm font-bold hover:bg-darkblue-light transition shadow-lg">
                Publish Selected
            </button>
        </div>
    </div>

    {{-- Summary Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-gold">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Awaiting Publication</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">142</h3>
            <div class="mt-2 text-[10px] text-amber-600 font-bold uppercase">Ready for release</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-darkblue">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Total Approved</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">1,204</h3>
            <div class="mt-2 text-[10px] text-green-600 font-bold uppercase">All batches cleared</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-stone-300">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Avg. Performance</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">B+ (3.42)</h3>
            <div class="mt-2 text-[10px] text-stone-500 font-bold uppercase">Current Semester</div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex flex-col md:flex-row md:items-center gap-4 w-full">
                {{-- Search Input --}}
                <div class="relative max-w-xs w-full md:flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search departments..." class="block w-full pl-10 pr-3 py-2 border border-stone-200 rounded-lg text-sm focus:ring-gold focus:border-gold outline-none">
                </div>

                {{-- Department Filter (New) --}}
                <div class="relative max-w-xs w-full md:w-auto">
                    <select wire:model.live="selectedDepartment" class="block w-full py-2 px-3 border border-stone-200 rounded-lg text-sm focus:ring-gold focus:border-gold outline-none appearance-none pr-8">
                        <option value="">All Departments</option>
                        {{-- Example departments (replace with dynamic data from Livewire component) --}}
                        <option value="cyber-security">Cyber Security</option>
                        <option value="computer-science">Computer Science</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-stone-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/50 text-stone-400 uppercase text-[10px] font-black tracking-widest border-b border-stone-100">
                        <th class="px-6 py-4">Department</th>
                        <th class="px-6 py-4 text-center">Semester</th>
                        <th class="px-6 py-4 text-center">Student Count</th>
                        <th class="px-6 py-4 text-center">Approved Date</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-50">
                    <!-- Mock Record 1 -->
                    <tr>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-bold text-stone-800">Cyber Security</div>
                                <div class="text-[10px] text-stone-500 font-medium uppercase tracking-tighter">Undergraduate Batch</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-stone-600">2023/2024 - 2nd</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">142</td>
                        <td class="px-6 py-4 text-center text-xs font-medium text-stone-500">Jan 10, 2024</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase rounded-md tracking-widest border border-amber-100">Approved</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-xs font-bold text-darkblue hover:underline">Publish</button>
                        </td>
                    </tr>
                    <!-- Mock Record 2 -->
                    <tr>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-bold text-stone-800">Computer Science</div>
                                <div class="text-[10px] text-stone-500 font-medium uppercase tracking-tighter">Undergraduate Batch</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-stone-600">2023/2024 - 2nd</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">85</td>
                        <td class="px-6 py-4 text-center text-xs font-medium text-stone-500">Jan 11, 2024</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 bg-amber-50 text-amber-600 text-[10px] font-black uppercase rounded-md tracking-widest border border-amber-100">Approved</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-xs font-bold text-darkblue hover:underline">Publish</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 