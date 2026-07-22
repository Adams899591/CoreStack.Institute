<div class="space-y-8"> 
    

    {{-- Available Courses Box (Current Semester) --}}
    <div class="p-6 bg-white border border-stone-200 rounded-xl shadow-sm">
        
        {{-- Table Header Info --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-stone-800 tracking-tight">Available Courses (Current Semester)</h2>
                <p class="text-xs text-stone-500 mt-1">Select the regular courses you want to register for this semester.</p>
            </div>
            <div class="text-xs font-bold uppercase tracking-wider text-stone-600 bg-stone-50 px-4 py-2 rounded-lg border border-stone-200">
                Selected Credit Units: 
                <span class="{{ $this->combinedTotalUnits > ($totalUnits + 6) ? 'text-red-600' : 'text-darkblue' }} font-black text-sm">
                    {{ $this->combinedTotalUnits }}
                </span> / {{ $totalUnits + 6 }} Max
            </div>
        </div>

        {{-- Regular Courses Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0">
                <thead>
                    <tr class="bg-stone-50">
                        <th class="w-12 px-4 py-3 border-y border-l rounded-tl-lg text-center">
                            <input 
                                type="checkbox" 
                                wire:click="toggleAllRegular({{ $semesterCourses->pluck('id') }})"
                                @checked(count($selectedRegularCourses) === $semesterCourses->count() && $semesterCourses->count() > 0)
                                class="w-4 h-4 rounded border-stone-300 text-darkblue focus:ring-gold cursor-pointer"
                            >
                        </th>
                        <th class="px-4 py-3 border-y text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Course Code</th>
                        <th class="px-4 py-3 border-y text-left text-xs font-semibold text-stone-600 uppercase tracking-wider">Course Title</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-stone-600 uppercase tracking-wider">Credit Unit</th>
                        <th class="px-4 py-3 border-y border-r rounded-tr-lg text-center text-xs font-semibold text-stone-600 uppercase tracking-wider">Category</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-stone-200">
                    @foreach ($semesterCourses as $semesterCourse)
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectedRegularCourses" 
                                    value="{{ $semesterCourse->id }}" 
                                    class="w-4 h-4 rounded border-stone-300 text-darkblue focus:ring-gold cursor-pointer"
                                >
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-stone-600">{{ $semesterCourse->course_code }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-stone-900">{{ $semesterCourse->course_name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-stone-800 text-center font-bold">{{ (float) $semesterCourse->units }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $semesterCourse->category }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 

    {{-- CONDITIONAL CARRY-OVER SECTION: Only renders if student has failed courses --}}
    @if ($failedCourses->isNotEmpty())
        
        {{-- Detector Banner --}}
        <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start space-x-3 shadow-sm">
            <div class="flex-shrink-0 text-red-500 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-black text-red-800 uppercase tracking-wider">Outstanding Failed Courses Detector</h4>
                <p class="text-xs text-red-700 mt-0.5 font-medium">The items listed below are your failed/carry-over courses from previous semesters. Please check and select them to add them to your current registration.</p>
            </div>
        </div>

        {{-- Carry-Over Selection Box --}}
        <div class="p-6 bg-white border border-stone-200 rounded-xl shadow-sm">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-stone-800 tracking-tight flex items-center">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 mr-2 animate-pulse"></span>
                        Carry-Over Course Selection
                    </h2>
                    <p class="text-xs text-stone-500 mt-1">Select outstanding deficiencies to register them along with your current workload.</p>
                </div>
                <p class="text-xs font-bold text-stone-600">Carry-over Units: <span class="text-red-600 font-black text-sm">{{ $this->selectedUnits }}</span></p>
            </div>

            {{-- Failed Courses Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-red-50/30">
                            <th class="w-12 px-4 py-3 border-y border-l rounded-tl-lg text-center">
                                <input 
                                    type="checkbox" 
                                    wire:click="toggleAllFailed({{ $failedCourses->pluck('id') }})"
                                    @checked(count($selectedCourses) === $failedCourses->count() && $failedCourses->count() > 0)
                                    class="w-4 h-4 rounded border-red-300 text-red-600 focus:ring-red-500 cursor-pointer"
                                >
                            </th>
                            <th class="px-4 py-3 border-y text-left text-xs font-semibold text-red-900 uppercase tracking-wider">Course Code</th>
                            <th class="px-4 py-3 border-y text-left text-xs font-semibold text-red-900 uppercase tracking-wider">Course Title</th>
                            <th class="px-4 py-3 border-y text-center text-xs font-semibold text-red-900 uppercase tracking-wider">Credit Unit</th>
                            <th class="px-4 py-3 border-y border-r rounded-tr-lg text-center text-xs font-semibold text-red-900 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    
                    <tbody class="divide-y divide-red-100">
                        @foreach ($failedCourses as $failedCourse)
                            <tr class="hover:bg-red-50/10 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <input 
                                        type="checkbox" 
                                        wire:model.live="selectedCourses" 
                                        id="course-{{ $failedCourse->id }}" 
                                        value="{{ $failedCourse->id }}" 
                                        class="w-4 h-4 rounded border-red-300 text-red-600 focus:ring-red-500 cursor-pointer"
                                    >
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-stone-600">{{ $failedCourse->course_code }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-stone-900">{{ $failedCourse->course_name }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-stone-800 text-center font-bold">{{ (float) $failedCourse->units }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-red-100 text-red-700 border border-red-200">
                                        Carry-Over
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif


    {{-- Error Flash Message --}}
    @error('selectedCourses')
        <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-xs font-semibold">
            {{ $message }}
        </div>
    @enderror


    {{-- Main Form Submission Action Bar (Bottom of Page) --}}
    <div class="flex flex-col items-end gap-2 pt-4 border-t border-stone-200">
        
        {{-- Unit Exceeded Warning Alert --}}
        @if($this->combinedTotalUnits > ($totalUnits + 6))
            <p class="text-xs font-bold text-red-600 flex items-center gap-1 animate-bounce">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Maximum unit limit exceeded ({{ $totalUnits + 6 }} Max). Please uncheck some courses to proceed.
            </p>
        @endif

        <button 
            type="button" 
            wire:click="registerSelectedCourses"
            wire:loading.attr="disabled"
            @disabled($this->combinedTotalUnits > ($totalUnits + 6))
            class="px-8 py-3 bg-darkblue text-white text-xs font-bold uppercase tracking-widest rounded-lg transition shadow-md 
                   hover:bg-darkblue-light 
                   disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-darkblue
                   inline-flex items-center gap-2"
         >
            {{-- Loading Spinner Icon --}}
            <svg wire:loading wire:target="registerSelectedCourses" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>

            {{-- Text states --}}
            <span wire:loading.remove wire:target="registerSelectedCourses">
                Confirm & Register Selected Courses
            </span>
            <span wire:loading wire:target="registerSelectedCourses">
                Processing Registration...
            </span>
        </button>
    </div>

</div>