
<div> 
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg flex items-start space-x-3 shadow-sm">
        <div class="flex-shrink-0 text-red-500 mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div>
            <h4 class="text-xs font-black text-red-800 uppercase tracking-wider">Outstanding Academic Deficiency</h4>
            <p class="text-xs text-red-700 mt-0.5 font-medium">Attention: You have outstanding failed courses from other academic sections. Please ensure these carry-over courses are prioritized during your next registration period.</p>
        </div>
    </div>

    <div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm">

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


                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-200">

                    @php
                        $SN = 1;
                    @endphp
                    
                    {{-- Table Data --}}
                    @foreach ($results as $result)
                        

                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{$SN++}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{$result->Course->course_name}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-707 text-center bg-gray-50/30">{{ rtrim(rtrim($result->Course->units, "0"), '.')}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{$result->grade_1 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400'}}">{{$result->grade_1}}</span></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{$result->grade_2 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400'}}">{{$result->grade_2}}</span></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{$result->grade_3 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400'}}">{{$result->grade_3}}</span></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center"><span class="{{$result->grade_4 > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400'}}">{{$result->grade_4}}</span></td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-center {{$result->exam_score > 0 ? 'font-bold text-gray-900' : 'font-normal text-gray-400'}}">{{ $result->exam_score > 0 ? round($result->exam_score) : "0.0"}}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{$result->Course->category}}</span>
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
                Total Credit Unit: <span class="text-lg font-bold text-gray-900 ml-1">{{$totalUints}}</span>
            </div>
            <div class="mt-1">
                <p class="text-[10px] uppercase tracking-tighter text-rose-500 font-semibold">
                    confirm by Exzan officer
                </p>
            </div>
        </div>
    </div>

</div>