<div x-data="{ showCreateModal: false, showEditModal: false, showDeleteModal: false }" class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-stone-800 tracking-tight">Course Catalog</h1>
            <p class="text-sm text-stone-500">Manage and organize the academic syllabus and course offerings.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="bg-white border border-stone-200 text-stone-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-stone-50 transition">
                Export PDF
            </button>
            <button @click="showCreateModal = true" class="bg-gold hover:bg-gold-dark text-white px-5 py-2.5 rounded-lg text-sm font-bold transition flex items-center shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Create New Course
            </button>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white p-4 rounded-xl border border-stone-200 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-stone-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search courses..." class="w-full pl-10 pr-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
            </div>
            <select class="bg-stone-50 border border-stone-200 rounded-lg py-2 px-3 text-sm text-stone-600 focus:outline-none focus:border-gold">
                <option>All Departments</option>
                <option>Computer Science</option>
                <option>Engineering</option>
            </select>
            <select class="bg-stone-50 border border-stone-200 rounded-lg py-2 px-3 text-sm text-stone-600 focus:outline-none focus:border-gold">
                <option>Academic Level</option>
                <option>100 Level</option>
                <option>200 Level</option>
            </select>
            <select class="bg-stone-50 border border-stone-200 rounded-lg py-2 px-3 text-sm text-stone-600 focus:outline-none focus:border-gold">
                <option>Status</option>
                <option>Active</option>
                <option>Archived</option>
            </select>
        </div>
    </div>

    <!-- Course List Table -->
    <div class="bg-white rounded-xl border border-stone-200 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-stone-50 border-b border-stone-200">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider">Course Code</th>
                    <th class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider">Course Title</th>
                    <th class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider">Credit Unit</th>
                    <th class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider">Department</th>
                    <th class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                <!-- Placeholder Row -->
                <tr class="hover:bg-stone-50/50 transition">
                    <td class="px-6 py-4 text-sm font-bold text-darkblue">CSC 101</td>
                    <td class="px-6 py-4 text-sm text-stone-700 font-medium">Introduction to Computing</td>
                    <td class="px-6 py-4 text-sm text-stone-600">3.0 Units</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-darkblue/5 text-darkblue uppercase tracking-tight">
                            Comp. Science
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <!-- EDIT BUTTON: Trigger modal and pass ID to Livewire (e.g. @click="showEditModal = true; $wire.loadCourse(ID)") -->
                        <button @click="showEditModal = true" wire:loading.attr="disabled" class="text-stone-400 hover:text-gold transition disabled:opacity-50 disabled:cursor-wait">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <!-- DELETE BUTTON: Trigger modal and pass ID to Livewire (e.g. @click="showDeleteModal = true; $wire.setDeleteId(ID)") -->
                        <button @click="showDeleteModal = true" wire:loading.attr="disabled" class="text-stone-400 hover:text-red-500 transition disabled:opacity-50 disabled:cursor-wait">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Empty State Hint -->
        <div class="p-8 text-center bg-stone-50/30">
            <p class="text-xs text-stone-400 italic">Static data preview - connect backend to populate dynamic records.</p>
        </div>
    </div>

    <!-- Create Course Modal -->
    <div x-show="showCreateModal" 
         x-cloak 
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-stone-900/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showCreateModal = false" 
             class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg border border-stone-200 overflow-hidden"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
                <h3 class="text-lg font-bold text-stone-800">Create New Course</h3>
                <button @click="showCreateModal = false" class="text-stone-400 hover:text-stone-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Course Code</label>
                        <input type="text" placeholder="e.g. CSC 101" class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Credit Units</label>
                        <select class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                            <option>Select Units</option>
                            <option>1.0 Unit</option>
                            <option>2.0 Units</option>
                            <option>3.0 Units</option>
                            <option>4.0 Units</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Course Title</label>
                    <input type="text" placeholder="Full name of the course" class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Department</label>
                    <select class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                        <option>Select Department</option>
                        <option>Computer Science</option>
                        <option>Engineering</option>
                    </select>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100 flex items-center justify-end gap-3">
                <button @click="showCreateModal = false" class="px-4 py-2 text-sm font-semibold text-stone-600 hover:text-stone-800 transition">Cancel</button>
                <button wire:loading.attr="disabled" class="bg-darkblue hover:bg-darkblue-light text-white px-6 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center disabled:opacity-75 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Save Course</span>
                    <span wire:loading class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Saving...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div x-show="showEditModal" 
         x-cloak 
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-stone-900/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showEditModal = false" 
             class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg border border-stone-200 overflow-hidden"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-stone-50/50">
                <h3 class="text-lg font-bold text-stone-800">Edit Course</h3>
                <button @click="showEditModal = false" class="text-stone-400 hover:text-stone-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Course Code</label>
                        <input type="text" placeholder="e.g. CSC 101" class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Credit Units</label>
                        <select class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                            <option>Select Units</option>
                            <option>1.0 Unit</option>
                            <option>2.0 Units</option>
                            <option>3.0 Units</option>
                            <option>4.0 Units</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Course Title</label>
                    <input type="text" placeholder="Full name of the course" class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-stone-600 uppercase tracking-wider mb-1">Department</label>
                    <select class="w-full px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg text-sm focus:outline-none focus:border-gold transition">
                        <option>Select Department</option>
                        <option>Computer Science</option>
                        <option>Engineering</option>
                    </select>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100 flex items-center justify-end gap-3">
                <button @click="showEditModal = false" class="px-4 py-2 text-sm font-semibold text-stone-600 hover:text-stone-800 transition">Cancel</button>
                <!-- SAVE ACTION: Pass ID to Livewire save method here (e.g. wire:click="updateCourse") -->
                <button wire:loading.attr="disabled" class="bg-gold hover:bg-gold-dark text-white px-6 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center disabled:opacity-75 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Update Course</span>
                    <span wire:loading class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Updating...</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" 
         x-cloak 
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto bg-stone-900/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="showDeleteModal = false" 
             class="relative bg-white rounded-2xl shadow-xl w-full max-md border border-stone-200 overflow-hidden"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-stone-100 flex items-center justify-between bg-red-50/50">
                <div class="flex items-center gap-2 text-red-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <h3 class="text-lg font-bold">Confirm Deletion</h3>
                </div>
                <button @click="showDeleteModal = false" class="text-stone-400 hover:text-stone-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <p class="text-sm text-stone-600 leading-relaxed">
                    Are you sure you want to delete this course? This action <span class="font-bold text-red-600">cannot be undone</span> and will permanently remove the course from the catalog.
                </p>
                
                <!-- Warning Preview -->
                <div class="mt-4 p-3 bg-stone-50 rounded-lg border border-stone-100">
                    <p class="text-[10px] font-bold text-stone-400 uppercase">Deleting Course</p>
                    <p class="text-sm font-bold text-stone-700">CSC 101 - Introduction to Computing</p>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-stone-50 border-t border-stone-100 flex items-center justify-end gap-3">
                <button @click="showDeleteModal = false" class="px-4 py-2 text-sm font-semibold text-stone-600 hover:text-stone-800 transition">Cancel</button>
                <!-- DELETE ACTION: Pass Course ID to Livewire delete method here (e.g. wire:click="deleteCourse") -->
                <button wire:loading.attr="disabled" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center disabled:opacity-75 disabled:cursor-not-allowed">
                    <span wire:loading.remove>Delete Permanently</span>
                    <span wire:loading class="flex items-center"><svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Deleting...</span>
                </button>
            </div>
        </div>
    </div>
</div>
 