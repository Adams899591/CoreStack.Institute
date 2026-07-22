<div>  

    {{-- Display Semester Academic Record Table if  $semesterCourses is not empty--}}
    @if ($semesterCourses->isNotEmpty())

            {{-- Main Table Section: Regular / Current Semester Academic Record --}}
            <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm mb-6">

                {{-- Header Section --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Semester Academic Record</h2>
                    <span class="text-xs font-medium px-2.5 py-0.5 rounded bg-gray-100 text-gray-800 border border-gray-300">Official Transcript</span>
                </div>

                {{-- Table Section --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full border-separate border-spacing-0">

                        {{-- Table Header --}}
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-3 border-y border-l rounded-tl-lg text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">S/N</th>
                                <th class="px-4 py-3 border-y text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Courses</th>
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

                        {{-- Table Body --}}
                        <tbody class="divide-y divide-gray-200">
                            @php $SN = 1; @endphp
                            
                                @foreach ($semesterCourses as $semesterCourse)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $SN++ }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $semesterCourse->Course->course_name }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">{{ rtrim(rtrim($semesterCourse->Course->units, "0"), '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $semesterCourse->grade_1 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $semesterCourse->grade_1 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $semesterCourse->grade_2 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $semesterCourse->grade_2 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $semesterCourse->grade_3 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $semesterCourse->grade_3 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $semesterCourse->grade_4 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $semesterCourse->grade_4 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center {{ $semesterCourse->exam_score > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $semesterCourse->exam_score > 0 ? round($semesterCourse->exam_score) : "0.0" }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $semesterCourse->Course->category }}</span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                                            <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest flex items-center justify-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                Approved
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                        </tbody>
                        
                    </table>
                </div>

                {{-- Table Footer Summary --}}
                <div class="mt-8 pt-4 border-t border-gray-100 flex flex-col items-end">
                    <div class="text-sm font-medium text-gray-500">
                        Total Credit Unit: <span class="text-lg font-bold text-gray-900 ml-1">{{ $totalUints }}</span>
                    </div>
                    <div class="mt-1">
                        <p class="text-[10px] uppercase tracking-tighter text-rose-500 font-semibold">
                            confirm by Exzan officer
                        </p>
                    </div>
                </div>
            </div>


            {{-- Carry-Over Courses Table Section (Only rendered if $CarryOverCourses is true) --}}
            @if($carryOverCourses)
                <div class="p-6 bg-white border border-red-200 rounded-xl shadow-sm">


                    {{-- Header Section --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <h3 class="text-lg font-bold text-gray-800 tracking-tight">Carry-Over Courses Record</h3>
                            <span class="text-[11px] font-semibold px-2 py-0.5 rounded bg-red-100 text-red-800 border border-red-300">
                                Registered Carry-Overs
                            </span>
                        </div>
                    </div>

                    {{-- Table Section --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-separate border-spacing-0">
                            <thead>
                                <tr class="bg-red-50/50">
                                    <th class="px-4 py-3 border-y border-l rounded-tl-lg text-xs font-semibold text-gray-600 uppercase tracking-wider text-center">S/N</th>
                                    <th class="px-4 py-3 border-y text-xs font-semibold text-gray-600 uppercase tracking-wider text-left">Courses</th>
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
                                @php $carrySN = 1; @endphp

                                @foreach ($carryOverCourses as $carryCourse)
                                    <tr class="hover:bg-red-50/20 transition-colors">
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $carrySN++ }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $carryCourse->Course->course_name }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 text-center bg-gray-50/30">{{ rtrim(rtrim($carryCourse->Course->units, "0"), '.') }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $carryCourse->grade_1 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $carryCourse->grade_1 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $carryCourse->grade_2 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $carryCourse->grade_2 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $carryCourse->grade_3 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $carryCourse->grade_3 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{ $carryCourse->grade_4 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $carryCourse->grade_4 ?? "0.0" }}</span></td>
                                        <td class="px-4 py-4 whitespace-nowrap text-sm text-center {{ $carryCourse->exam_score > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400' }}">{{ $carryCourse->exam_score > 0 ? round($carryCourse->exam_score) : "0.0" }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Carry Over
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm">
                                            <span class="text-green-600 font-bold uppercase text-[10px] tracking-widest flex items-center justify-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                Approved
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            @endif



    @else

            {{-- No Academic Record Found Section--}}
            <div class="p-8 text-center bg-white border border-gray-200 rounded-xl shadow-sm my-6">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-indigo-50 text-indigo-600 mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 tracking-tight">No Academic Record Found</h3>
                <p class="text-sm text-gray-500 max-w-md mx-auto mt-1 mb-6">
                    You have not registered your courses for the current academic semester yet. Please complete your course registration to view your assessment records.
                </p>
                <a href="{{ route('std.course-registration') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Proceed to Course Registration
                </a>
            </div>


    @endif


</div>