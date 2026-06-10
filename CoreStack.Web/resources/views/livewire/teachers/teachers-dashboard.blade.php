<div class="space-y-6">
    {{-- Welcome Header --}}
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-stone-800">Lecturer Overview</h1>
        <p class="text-sm text-stone-500">{{ now()->format('l, jS F Y') }}</p>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Active Courses (Indigo) -->
        <div class="bg-indigo-50 p-6 rounded-2xl border-t-4 border-indigo-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Active Courses</p>
                    <p class="text-3xl font-black text-indigo-900 mt-1">4</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Students (Amber) -->
        <div class="bg-amber-50 p-6 rounded-2xl border-t-4 border-amber-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-amber-600 uppercase tracking-widest">Total Students</p>
                    <p class="text-3xl font-black text-amber-900 mt-1">128</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 3: Pending Grades (Emerald) -->
        <div class="bg-emerald-50 p-6 rounded-2xl border-t-4 border-emerald-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Pending Grades</p>
                    <p class="text-3xl font-black text-emerald-900 mt-1">12</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Card 4: Next Lecture (Rose) -->
        <div class="bg-rose-50 p-6 rounded-2xl border-t-4 border-rose-500 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-rose-600 uppercase tracking-widest">Next Lecture</p>
                    <p class="text-2xl font-black text-rose-900 mt-1 uppercase tracking-tighter">10:30 AM</p>
                </div>
                <div class="p-3 bg-white rounded-xl shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Today's Classes --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm">
            <div class="p-4 border-b border-stone-100 bg-stone-50/50 rounded-t-xl font-bold text-sm text-stone-800">Today's Lecture Schedule</div>
            <div class="p-4 space-y-4">
                <div class="flex items-center p-3 rounded-lg border border-stone-100 hover:bg-stone-50 transition group">
                    <div class="w-16 text-center border-r border-stone-100 pr-3 mr-3"><span class="text-xs font-bold text-stone-400">09:00</span><br><span class="text-[10px] text-stone-400">AM</span></div>
                    <div class="flex-1"><h4 class="text-sm font-bold text-stone-800">CSC 301: Algorithms</h4><p class="text-[10px] text-gold font-bold">Hall A | 45 Students</p></div>
                    <button class="text-stone-300 group-hover:text-gold transition"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="flex items-center p-3 rounded-lg border border-stone-100 hover:bg-stone-50 transition group">
                    <div class="w-16 text-center border-r border-stone-100 pr-3 mr-3"><span class="text-xs font-bold text-stone-400">01:00</span><br><span class="text-[10px] text-stone-400">PM</span></div>
                    <div class="flex-1"><h4 class="text-sm font-bold text-stone-800">CSC 405: Cyber Ethics</h4><p class="text-[10px] text-gold font-bold">Lab 2 | 28 Students</p></div>
                    <button class="text-stone-300 group-hover:text-gold transition"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

        {{-- Recent Submissions --}}
        <div class="bg-white rounded-xl border border-stone-200 shadow-sm">
            <div class="p-4 border-b border-stone-100 bg-stone-50/50 rounded-t-xl font-bold text-sm text-stone-800">Recent Assignments Pending Review</div>
            <div class="flex items-center justify-center h-48 text-stone-400 text-xs italic">No new submissions found.</div>
        </div>
    </div>
</div>
