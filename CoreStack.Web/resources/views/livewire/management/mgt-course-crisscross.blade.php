<div class="space-y-6">
    <!-- Header Section -->
    <div class="border-b border-stone-200 pb-5">
        <h1 class="text-2xl font-bold text-stone-800 tracking-tight">Course Crisscross</h1>
        <p class="text-sm text-stone-500">Cross-reference and map course dependencies across departments and levels.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Selection Config Panel -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-xl border border-stone-200 shadow-sm space-y-4">
                <h3 class="text-xs font-bold text-gold uppercase tracking-widest">Configuration</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-600 mb-1">Source Department</label>
                        <select class="w-full bg-stone-50 border border-stone-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:border-gold">
                            <option>Select Department...</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-stone-600 mb-1">Target Department</label>
                        <select class="w-full bg-stone-50 border border-stone-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:border-gold">
                            <option>Select Department...</option>
                        </select>
                    </div>
                    <div class="pt-2">
                        <button class="w-full bg-darkblue text-white py-2.5 rounded-lg text-sm font-bold hover:bg-darkblue-light transition shadow-sm">
                            Generate Map
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-khaki/10 border border-gold/20 p-4 rounded-xl">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gold mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[11px] text-stone-600 leading-relaxed">
                        <strong class="text-stone-800">Pro Tip:</strong> Use the crisscross tool to identify overlapping prerequisites and shared elective courses across different faculties.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mapping Visualization Panel -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-stone-200 shadow-sm h-full min-h-[400px] flex flex-col">
                <div class="p-4 border-b border-stone-100 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-stone-800">Dependency Mapping</h3>
                    <div class="flex space-x-2">
                        <span class="flex items-center text-[10px] text-stone-400 font-bold uppercase"><span class="w-2 h-2 rounded-full bg-gold mr-1.5"></span> Core</span>
                        <span class="flex items-center text-[10px] text-stone-400 font-bold uppercase"><span class="w-2 h-2 rounded-full bg-darkblue mr-1.5"></span> Elective</span>
                    </div>
                </div>
                
                <div class="flex-1 p-8 flex items-center justify-center text-center">
                    <div class="max-w-xs">
                        <div class="w-16 h-16 bg-stone-50 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-dashed border-stone-200">
                            <svg class="w-8 h-8 text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.487V6.512a2 2 0 011.553-1.943L9 2l5.447 2.724A2 2 0 0116 6.512v8.975a2 2 0 01-1.553 1.943L9 20zm0 0V9"></path></svg>
                        </div>
                        <h4 class="text-sm font-bold text-stone-800 mb-1">No Mapping Selection</h4>
                        <p class="text-xs text-stone-500">Please select source and target departments to view the course crisscross dependencies.</p>
                    </div>
                </div>

                <!-- Static Legend/Footer -->
                <div class="p-4 bg-stone-50/50 border-t border-stone-100 grid grid-cols-2 gap-4">
                    <div class="flex items-center p-3 bg-white rounded-lg border border-stone-200 shadow-sm">
                        <div class="w-1 bg-gold h-8 rounded-full mr-3"></div>
                        <div>
                            <p class="text-[10px] text-stone-400 font-bold uppercase tracking-widest">Selected Source</p>
                            <p class="text-xs font-bold text-stone-700">None Selected</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-white rounded-lg border border-stone-200 shadow-sm">
                        <div class="w-1 bg-darkblue h-8 rounded-full mr-3"></div>
                        <div>
                            <p class="text-[10px] text-stone-400 font-bold uppercase tracking-widest">Selected Target</p>
                            <p class="text-xs font-bold text-stone-700">None Selected</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 