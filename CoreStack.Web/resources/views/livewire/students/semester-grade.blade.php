<div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 tracking-tight">Semester Academic Record</h2>
        <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800 border border-gray-300">Official Transcript</span>
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
                    <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Exam</th>
                    <th class="px-4 py-3 border-y text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                    <th class="px-4 py-3 border-y border-r rounded-tr-lg text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Approver</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                {{-- Static Content for demonstration --}}
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">1</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Introduction to Cyber Security</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">3</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">15.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">18.5</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">55.0</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Core</span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                        <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest flex items-center justify-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Approved
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">2</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Web Application Development</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">4</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">12.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">0.0</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">Elective</span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                        <span class="text-amber-500 font-medium italic text-[11px]">Pending</span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">3</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Data Structures and Algorithms</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">3</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">14.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">13.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">15.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-bold text-gray-900">10.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">60.0</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Core</span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                        <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest flex items-center justify-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            Approved
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">4</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">Cloud Computing Fundamentals</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">3</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="font-normal text-gray-400">0.0</span></td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-black text-gray-900">0.0</td>
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Core</span>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                        <span class="text-amber-500 font-medium italic text-[11px]">Pending</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-8 pt-4 border-t border-gray-100 flex flex-col items-end">
        <div class="text-sm font-medium text-gray-500">
            Total Credit Unit: <span class="text-lg font-bold text-gray-900 ml-1">13</span>
        </div>
        <div class="mt-1">
            <p class="text-[10px] uppercase tracking-tighter text-rose-500 font-semibold">
                confirm by Exzan officer
            </p>
        </div>
    </div>
</div>
