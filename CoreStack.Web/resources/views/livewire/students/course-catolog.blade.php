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
                    <!-- 100 Level First Semester -->
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm font-medium text-stone-500">01</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">
                            100 Level First Semester
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold bg-stone-100 text-stone-600 rounded-md uppercase">
                                100 Level
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-stone-600 font-medium">First</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-black text-stone-800">7</span>
                                <a href="{{ route('std.course-details') }}" wire:navigate class="inline-flex items-center px-4 py-1.5 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm hover:shadow-md focus:outline-none">
                                    <span>View</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- 100 Level Second Semester -->
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm font-medium text-stone-500">02</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">
                            100 Level Second Semester
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold bg-stone-100 text-stone-600 rounded-md uppercase">
                                100 Level
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-stone-600 font-medium">Second</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-black text-stone-800">8</span>
                                <a href="#" class="inline-flex items-center px-4 py-1.5 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm hover:shadow-md focus:outline-none">
                                    <span>View</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- 200 Level First Semester -->
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm font-medium text-stone-500">03</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">
                            200 Level First Semester
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold bg-stone-100 text-stone-600 rounded-md uppercase">
                                200 Level
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-stone-600 font-medium">First</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-black text-stone-800">9</span>
                                <a href="#" class="inline-flex items-center px-4 py-1.5 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm hover:shadow-md focus:outline-none">
                                    <span>View</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- 200 Level Second Semester -->
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-6 py-4 text-sm font-medium text-stone-500">04</td>
                        <td class="px-6 py-4 text-sm font-bold text-[#1A2B4C] uppercase tracking-tight">
                            200 Level Second Semester
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] font-bold bg-stone-100 text-stone-600 rounded-md uppercase">
                                200 Level
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-stone-600 font-medium">Second</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm font-black text-stone-800">7</span>
                                <a href="#" class="inline-flex items-center px-4 py-1.5 bg-[#D4AF37] hover:bg-[#B8860B] text-white text-[10px] font-black uppercase tracking-widest rounded-lg transition-all shadow-sm hover:shadow-md focus:outline-none">
                                    <span>View</span>
                                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
