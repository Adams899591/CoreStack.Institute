{{-- <div class="space-y-8"> <div class="p-6 bg-white border border-stone-200 rounded-xl shadow-sm">
        
        {{-- Table Header Info --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-stone-800 tracking-tight">Available Courses (Current Semester)</h2>
                <p class="text-xs text-stone-500 mt-1">Select the regular courses you want to register for this semester.</p>
            </div>
            <div class="text-xs font-bold uppercase tracking-wider text-stone-600 bg-stone-50 px-4 py-2 rounded-lg border border-stone-200">
                Selected Credit Units: <span class="text-darkblue font-black text-sm">{{$totalUnits + $this->selectedUnits}}</span> / {{$totalUnits + 6}} Max
            </div>
        </div>

        {{-- Regular Courses Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0">
                <thead>
                    <tr class="bg-stone-50">
                        <th class="w-12 px-4 py-3 border-y border-l rounded-tl-lg text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-stone-300 text-darkblue focus:ring-gold" checked >
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
                                <input type="checkbox" name="courses[]" value="1" class="w-4 h-4 rounded border-stone-300 text-darkblue focus:ring-gold" checked>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-stone-600">{{$semesterCourse->course_code}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-stone-900">{{$semesterCourse->course_name}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-stone-800 text-center font-bold">{{ rtrim(rtrim($semesterCourse->units, "0"), '.')}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{$semesterCourse->category}}</span>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div> 

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

    <div class="p-6 bg-white border border-stone-200 rounded-xl shadow-sm">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-stone-800 tracking-tight flex items-center">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 mr-2 animate-pulse"></span>
                Carry-Over Course Selection
            </h2>
            <p class="text-xs text-stone-500 mt-1">Select outstanding deficiencies to register them along with your current workload.</p>
        </div>

        {{-- Failed Courses Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border-separate border-spacing-0">
                <thead>
                    <tr class="bg-red-50/30">
                        <th class="w-12 px-4 py-3 border-y border-l rounded-tl-lg text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-red-300 text-red-600 focus:ring-red-500">
                        </th>
                        <th class="px-4 py-3 border-y text-left text-xs font-semibold text-red-900 uppercase tracking-wider">Course Code</th>
                        <th class="px-4 py-3 border-y text-left text-xs font-semibold text-red-900 uppercase tracking-wider">Course Title</th>
                        <th class="px-4 py-3 border-y text-center text-xs font-semibold text-red-900 uppercase tracking-wider">Credit Unit</th>
                        <th class="px-4 py-3 border-y border-r rounded-tr-lg text-center text-xs font-semibold text-red-900 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-red-100">

{{-- 
                        @foreach ($failedCourses as $failedCourse)
                            
                            <tr class="hover:bg-red-50/10 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <input type="checkbox" wire:model='selectedCourses' id="course-{{$failedCourse->id}}" name="failed_courses[]" value="{{ rtrim(rtrim($failedCourse->units, "0"), '.')}}" class="w-4 h-4 rounded border-red-300 text-red-600 focus:ring-red-500">
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-stone-600">{{$failedCourse->course_code}}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-stone-900">{{$failedCourse->course_name}}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-stone-800 text-center font-bold">{{ rtrim(rtrim($failedCourse->units, "0"), '.')}}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide bg-red-100 text-red-700 border border-red-200">
                                        Carry-Over
                                    </span>
                                </td>
                            </tr>

                        @endforeach --}}
  
<p>Selected Units: {{ $this->selectedUnits }} from failed courses</p>
                        @foreach ($failedCourses as $failedCourse)
    <tr class="hover:bg-red-50/10 transition-colors">
        <td class="px-4 py-4 whitespace-nowrap text-center">
            <input 
                type="checkbox" 
                wire:model.live="selectedCourses" 
                id="course-{{ $failedCourse->id }}" 
                value="{{ $failedCourse->id }}" 
                class="w-4 h-4 rounded border-red-300 text-red-600 focus:ring-red-500"
            >
        </td>
        <td class="px-4 py-4 whitespace-nowrap text-sm font-mono text-stone-600">
            {{ $failedCourse->course_code }}
        </td>
        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-stone-900">
            {{ $failedCourse->course_name }}
        </td>
        <td class="px-4 py-4 whitespace-nowrap text-sm text-stone-800 text-center font-bold">
            {{ (float) $failedCourse->units }}
        </td>
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

        {{-- Form Submission Footer --}}
        <div class="mt-8 flex justify-end border-t border-stone-100 pt-4">
            <button type="button" class="px-6 py-2.5 bg-darkblue text-white text-xs font-bold uppercase tracking-widest rounded-lg hover:bg-darkblue-light transition shadow-sm">
                Confirm & Register Selected Courses
            </button>
        </div>
    </div>

</div> --}}