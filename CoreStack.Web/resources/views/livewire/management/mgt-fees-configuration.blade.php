<div x-data="{ editModalOpen: false, deleteModalOpen: false, selectedFee: null }" class="p-4 sm:p-6 lg:p-8 bg-stone-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-black text-darkblue tracking-tighter uppercase">Fee Configuration</h1>
                <p class="text-sm text-gray-500 mt-1">Manage institutional fees, sessions, and departmental charges.</p>
            </div>
            <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gold hover:bg-gold-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold transition-all uppercase tracking-widest">
                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                New Fee Setup
            </button>
        </div>

        <!-- Main List -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fee Details</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Department & Level</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Session/Sem</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Amount</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
             
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">Tuition Fee 2024</div>
                                <div class="text-xs text-gray-500">Academic</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Computer Science</div>
                                <div class="text-xs text-gray-500">Level: 100</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">2023/2024</div>
                                <div class="text-xs text-gray-500">First Semester</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-darkblue">
                                45,000.00
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="editModalOpen = true" class="text-darkblue hover:text-gold transition mr-4 font-bold">Edit</button>
                                <button @click="deleteModalOpen = true" class="text-red-600 hover:text-red-800 transition font-bold">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">Library Maintenance</div>
                                <div class="text-xs text-gray-500">Ancillary</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">All Departments</div>
                                <div class="text-xs text-gray-500">Level: Any</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">2023/2024</div>
                                <div class="text-xs text-gray-500">Annual</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-darkblue">
                                5,500.00
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="editModalOpen = true" class="text-darkblue hover:text-gold transition mr-4 font-bold">Edit</button>
                                <button @click="deleteModalOpen = true" class="text-red-600 hover:text-red-800 transition font-bold">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                    <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-xs text-gray-700">
                            Showing <span class="font-bold">1</span> to <span class="font-bold">2</span> of <span class="font-bold">2</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button aria-current="page" class="z-10 bg-darkblue border-darkblue text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</button>
                            <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div x-show="editModalOpen" x-cloak class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-stone-900 bg-opacity-75 transition-opacity" @click="editModalOpen = false"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="editModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-stone-200">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gold/10 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                         <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        
                            <h3 class="text-lg leading-6 font-black text-darkblue uppercase tracking-tighter" id="modal-title">Edit Fee Configuration</h3>
                            <div class="mt-2">
         <p class="text-xs text-stone-500 mb-6 italic">Update the details for the selected fee structure. Changes will take effect immediately for new registrations.</p>
                                
                                <div class="space-y-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="text-left">
                                            <label class="block text-[10px] font-black text-darkblue uppercase tracking-widest mb-1">Fee Name</label>
                                            <input type="text" class="w-full rounded-lg border-stone-200 focus:border-gold focus:ring focus:ring-gold/20 transition-all text-sm shadow-sm" placeholder="e.g., Tuition Fee 2024">
                                        </div>
                                        <div class="text-left">
                                            <label class="block text-[10px] font-black text-darkblue uppercase tracking-widest mb-1">Category</label>
                                            <select class="w-full rounded-lg border-stone-200 focus:border-gold focus:ring focus:ring-gold/20 transition-all text-sm shadow-sm">
                                                <option>Academic</option>
                                                <option>Ancillary</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="text-left">
                                            <label class="block text-[10px] font-black text-darkblue uppercase tracking-widest mb-1">Department</label>
                                            <select class="w-full rounded-lg border-stone-200 focus:border-gold focus:ring focus:ring-gold/20 transition-all text-sm shadow-sm">
                                                <option>Computer Science</option>
                                                <option>Cyber Security</option>
                                                <option>All Departments</option>
                                            </select>
                                        </div>
                                        <div class="text-left">
                                            <label class="block text-[10px] font-black text-darkblue uppercase tracking-widest mb-1">Amount (₦)</label>
                                            <input type="number" class="w-full rounded-lg border-stone-200 focus:border-gold focus:ring focus:ring-gold/20 transition-all text-sm font-mono font-bold text-darkblue shadow-sm" placeholder="0.00">
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <label class="block text-[10px] font-black text-darkblue uppercase tracking-widest mb-1">Status</label>
                                        <select class="w-full rounded-lg border-stone-200 focus:border-gold focus:ring focus:ring-gold/20 transition-all text-sm shadow-sm">
                                            <option>Active</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-stone-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-base font-bold text-white hover:bg-gold-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:ml-3 sm:w-auto sm:text-sm uppercase tracking-widest" @click="editModalOpen = false">Save Changes</button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-lg border border-stone-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-stone-700 hover:bg-stone-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="editModalOpen = false">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="deleteModalOpen" x-cloak class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-stone-900 bg-opacity-75 transition-opacity" @click="deleteModalOpen = false"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-stone-200">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-black text-darkblue uppercase tracking-tighter" id="modal-title">Delete Configuration</h3>
                            <div class="mt-2">
                                <p class="text-sm text-stone-500">Are you sure you want to delete this fee setup? This action cannot be undone and may affect active student records.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-stone-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-bold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm uppercase tracking-widest" @click="deleteModalOpen = false">Delete Permanently</button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-lg border border-stone-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-stone-700 hover:bg-stone-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="deleteModalOpen = false">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
