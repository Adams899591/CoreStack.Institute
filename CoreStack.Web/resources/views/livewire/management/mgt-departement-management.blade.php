<div class="p-6">
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Department Management</h1>
            <p class="mt-2 text-sm text-gray-700">Manage academic departments, assign Heads of Department (HOD), and track student distribution.</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <button class="inline-flex items-center justify-center rounded-md border border-transparent bg-darkblue px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-darkblue-light focus:outline-none focus:ring-2 focus:ring-darkblue focus:ring-offset-2 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add Department
            </button>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-stone-200 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="relative max-w-sm w-full">
            <input type="text" 
                class="block w-full rounded-md border-gray-300 pl-10 focus:border-gold focus:ring-gold sm:text-sm" 
                placeholder="Search departments...">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <select class="rounded-md border-gray-300 text-sm focus:border-gold focus:ring-gold">
                <option>All Faculties</option>
                <option>Science & Technology</option>
                <option>Arts & Humanities</option>
                <option>Social Sciences</option>
            </select>
        </div>
    </div>

    <!-- Departments Table -->
    <div class="flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-bold text-darkblue sm:pl-6 uppercase tracking-wider">Department & Code</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-darkblue uppercase tracking-wider">Faculty</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-darkblue uppercase tracking-wider">H.O.D</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-darkblue uppercase tracking-wider text-center">Students</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-darkblue uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <!-- Static Row 1 -->
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex flex-col">
                                        <div class="font-bold text-gray-900">Computer Science</div>
                                        <div class="text-xs text-gold font-medium">CSC</div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Science & Technology</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">Dr. Albert Einstein</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">452</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold leading-5 text-green-800">Active</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button class="text-darkblue hover:text-gold mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                            <!-- Static Row 2 -->
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex flex-col">
                                        <div class="font-bold text-gray-900">Mechanical Engineering</div>
                                        <div class="text-xs text-gold font-medium">MEE</div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Engineering</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">Prof. Nikola Tesla</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">318</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold leading-5 text-green-800">Active</span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button class="text-darkblue hover:text-gold mr-3">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination UI -->
    <div class="mt-6 flex items-center justify-between">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">2</span> departments
        </div>
        <div class="flex space-x-2">
            <button class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed" disabled>Previous</button>
            <button class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Next</button>
        </div>
    </div>
</div>
