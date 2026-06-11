<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-stone-800 tracking-tight uppercase">Published Results</h1>
            <p class="text-sm text-stone-500 font-medium">Historical data of results released to students.</p>
        </div>
        <div class="flex items-center space-x-3">
            <button class="px-4 py-2 bg-white border border-stone-200 text-stone-600 rounded-lg text-sm font-bold hover:bg-stone-50 transition">
                Download Archive
            </button>
        </div>
    </div>

    {{-- Summary Statistics --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-gold">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Live Results</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">4,850</h3>
            <div class="mt-2 text-[10px] text-green-600 font-bold uppercase">Available in portal</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-darkblue">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Students Notified</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">100%</h3>
            <div class="mt-2 text-[10px] text-stone-500 font-bold uppercase">SMS & Email alerts sent</div>
        </div>
        <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-sm border-l-4 border-stone-300">
            <p class="text-xs font-bold text-stone-400 uppercase tracking-widest">Last Update</p>
            <h3 class="text-2xl font-black text-stone-800 mt-1">Today</h3>
            <div class="mt-2 text-[10px] text-stone-500 font-bold uppercase">Released at 09:45 AM</div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="relative max-w-xs w-full">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search departments..." class="block w-full pl-10 pr-3 py-2 border border-stone-200 rounded-lg text-sm focus:ring-gold focus:border-gold outline-none">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-stone-50/50 text-stone-400 uppercase text-[10px] font-black tracking-widest border-b border-stone-100">
                        <th class="px-6 py-4">Department</th>
                        <th class="px-6 py-4 text-center">Semester</th>
                        <th class="px-6 py-4 text-center">Batch Size</th>
                        <th class="px-6 py-4 text-center">Avg. GPA</th>
                        <th class="px-6 py-4 text-center">Published Date</th>
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
                                <div class="text-[10px] text-stone-500 font-medium uppercase tracking-tighter">Undergraduate</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-stone-600">2023/2024 - 2nd</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">124</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">3.45</td>
                        <td class="px-6 py-4 text-center text-xs font-medium text-stone-500">Jan 12, 2024</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-md tracking-widest border border-green-100">Live</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-xs font-bold text-stone-400 hover:text-red-600 transition">Unpublish</button>
                        </td>
                    </tr>
                    <!-- Mock Record 2 -->
                    <tr>
                        <td class="px-6 py-4">
                            <div>
                                <div class="text-sm font-bold text-stone-800">Computer Science</div>
                                <div class="text-[10px] text-stone-500 font-medium uppercase tracking-tighter">Undergraduate</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-xs font-bold text-stone-600">2023/2024 - 2nd</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">98</td>
                        <td class="px-6 py-4 text-center text-sm font-black text-stone-800">3.12</td>
                        <td class="px-6 py-4 text-center text-xs font-medium text-stone-500">Jan 12, 2024</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-md tracking-widest border border-green-100">Live</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-xs font-bold text-stone-400 hover:text-red-600 transition">Unpublish</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 