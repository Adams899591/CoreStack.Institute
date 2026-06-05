<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Enrolled Courses (Indigo) -->
        <div class="bg-indigo-50 p-6 rounded-2xl border-t-4 border-indigo-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Enrolled Courses</p>
                    <p class="text-3xl font-black text-indigo-900 mt-1">5</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 2: Upcoming Assignments (Amber) -->
        <div class="bg-amber-50 p-6 rounded-2xl border-t-4 border-amber-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-600 uppercase tracking-widest">Upcoming Tasks</p>
                    <p class="text-3xl font-black text-amber-900 mt-1">3</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M12 16h.01"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 3: Current GPA (Emerald) -->
        <div class="bg-emerald-50 p-6 rounded-2xl border-t-4 border-emerald-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Current GPA</p>
                    <p class="text-3xl font-black text-emerald-900 mt-1">3.85</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.691h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.519 4.674c.3.921-.755 1.688-1.539 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.363-1.118L2.92 10.102c-.783-.57-.381-1.81.588-1.81h4.915a1 1 0 00.95-.691l1.519-4.674z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 4: Unread Notifications (Rose) -->
        <div class="bg-rose-50 p-6 rounded-2xl border-t-4 border-rose-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-rose-600 uppercase tracking-widest">Unread Alerts</p>
                    <p class="text-3xl font-black text-rose-900 mt-1">7</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Grades: All-Card View -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-stone-800">Recent Grades</h2>
            <a href="#" class="text-sm text-gold hover:underline font-medium">View All</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Grade Card 1 -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-stone-200 flex flex-col justify-between space-y-4 hover:border-indigo-300 transition-colors">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <h3 class="font-bold text-stone-900">Calculus I</h3>
                        <p class="text-xs text-stone-500">Midterm Exam</p>
                    </div>
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-black uppercase">A-</span>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                    <span class="text-[10px] font-bold text-stone-400 uppercase">May 28, 2026</span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter">Completed</span>
                </div>
            </div>
            <!-- Grade Card 2 -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-stone-200 flex flex-col justify-between space-y-4 hover:border-indigo-300 transition-colors">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <h3 class="font-bold text-stone-900">Physics II</h3>
                        <p class="text-xs text-stone-500">Lab Report 3</p>
                    </div>
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-black uppercase">B+</span>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                    <span class="text-[10px] font-bold text-stone-400 uppercase">May 25, 2026</span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-tighter">Completed</span>
                </div>
            </div>
            <!-- Grade Card 3 -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-stone-200 flex flex-col justify-between space-y-4 hover:border-amber-300 transition-colors">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <h3 class="font-bold text-stone-900">Comp Sci 101</h3>
                        <p class="text-xs text-stone-500">Project Proposal</p>
                    </div>
                    <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-lg text-xs font-black uppercase">--</span>
                </div>
                <div class="flex items-center justify-between pt-4 border-t border-stone-100">
                    <span class="text-[10px] font-bold text-stone-400 uppercase">May 20, 2026</span>
                    <span class="text-[10px] font-black text-amber-600 uppercase tracking-tighter">Pending</span>
                </div>
            </div>
        </div>
    </div>
</div>
