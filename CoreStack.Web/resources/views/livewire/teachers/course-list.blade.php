<div>
    <div class="mb-8">
        <h1 class="text-2xl font-black text-darkblue tracking-tight">MY ASSIGNED COURSES</h1>
        <p class="text-sm text-stone-500">Overview of your academic load for the current semester.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


        @forelse ($courses as $course)
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="px-2 py-1 bg-darkblue/10 text-darkblue text-[10px] font-bold rounded uppercase tracking-wider">{{$course->course_code}}</span>
                        <span class="text-[10px] font-bold text-gold uppercase">{{ ucfirst($course->status ?? 'active') }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-stone-800 leading-tight mb-2">{{$course->course_name}}</h3>
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-xs text-stone-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            {{ $course->results_count ?? 0 }} Result Entries
                        </div>
                        <div class="flex items-center text-xs text-stone-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $course->semester ?? 'Current Semester' }}
                        </div>
                    </div>
                    <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                        <button class="text-xs font-bold text-darkblue hover:text-gold transition uppercase tracking-tighter">View Materials</button>
                        <a href="#" class="px-4 py-2 bg-darkblue text-white text-xs font-bold rounded-lg hover:bg-darkblue-light transition">Manage</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-stone-300 bg-white p-8 text-center text-sm text-stone-500">
                No courses found for your current academic period yet.
            </div>
        @endforelse

        <!-- Course Card 2 -->
        {{-- <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 bg-darkblue/10 text-darkblue text-[10px] font-bold rounded uppercase tracking-wider">CSC 405</span>
                    <span class="text-[10px] font-bold text-gold uppercase">Active</span>
                </div>
                <h3 class="text-lg font-bold text-stone-800 leading-tight mb-2">Advanced Software Engineering</h3>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-xs text-stone-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        32 Enrolled Students
                    </div>
                    <div class="flex items-center text-xs text-stone-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tue, Thu (02:00 PM - 04:00 PM)
                    </div>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                    <button class="text-xs font-bold text-darkblue hover:text-gold transition uppercase tracking-tighter">View Materials</button>
                    <a href="#" class="px-4 py-2 bg-darkblue text-white text-xs font-bold rounded-lg hover:bg-darkblue-light transition">Manage</a>
                </div>
            </div>
        </div> --}}

        <!-- Course Card 3 -->
        {{-- <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-md transition-shadow">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 bg-darkblue/10 text-darkblue text-[10px] font-bold rounded uppercase tracking-wider">CSC 202</span>
                    <span class="text-[10px] font-bold text-gold uppercase">Active</span>
                </div>
                <h3 class="text-lg font-bold text-stone-800 leading-tight mb-2">Intro to Object Oriented Programming</h3>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-xs text-stone-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        58 Enrolled Students
                    </div>
                    <div class="flex items-center text-xs text-stone-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Friday (08:00 AM - 11:00 AM)
                    </div>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                    <button class="text-xs font-bold text-darkblue hover:text-gold transition uppercase tracking-tighter">View Materials</button>
                    <a href="#" class="px-4 py-2 bg-darkblue text-white text-xs font-bold rounded-lg hover:bg-darkblue-light transition">Manage</a>
                </div>
            </div>
        </div> --}}
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="mt-12 bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-stone-100 bg-stone-50/50">
            <h3 class="text-sm font-black text-darkblue uppercase tracking-widest">Upcoming Lectures</h3>
        </div>
        <div class="divide-y divide-stone-100">
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center text-gold font-bold text-xs">10</div>
                    <div>
                        <p class="text-xs font-bold text-stone-800">CSC 301 - Main Auditorium</p>
                        <p class="text-[10px] text-stone-500 uppercase tracking-tighter">Starts in 45 minutes</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold py-1 px-3 rounded-full bg-stone-100 text-stone-600 uppercase">Today</span>
            </div>
            <div class="p-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-darkblue/10 flex items-center justify-center text-darkblue font-bold text-xs">14</div>
                    <div>
                        <p class="text-xs font-bold text-stone-800">CSC 405 - Lab 2</p>
                        <p class="text-[10px] text-stone-500 uppercase tracking-tighter">Tomorrow at 2:00 PM</p>
                    </div>
                </div>
                <span class="text-[10px] font-bold py-1 px-3 rounded-full bg-stone-100 text-stone-600 uppercase">Tomorrow</span>
            </div>
        </div>
    </div>
</div>
