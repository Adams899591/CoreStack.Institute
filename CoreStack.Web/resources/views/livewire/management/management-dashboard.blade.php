<div>
    <div class="mb-8">
        <h1 class="text-3xl font-black text-stone-800 tracking-tight">Management Dashboard</h1>
        <p class="text-stone-500 text-sm mt-1">Overview of institutional operations and statistics.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Students -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center">
            <div class="p-3 bg-blue-50 rounded-xl mr-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <p class="text-stone-400 text-xs font-bold uppercase tracking-widest">Total Students</p>
                <p class="text-2xl font-black text-stone-800">1,284</p>
            </div>
        </div>

        <!-- Total Lecturers -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center">
            <div class="p-3 bg-gold/10 rounded-xl mr-4">
                <svg class="w-6 h-6 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="text-stone-400 text-xs font-bold uppercase tracking-widest">Lecturers</p>
                <p class="text-2xl font-black text-stone-800">86</p>
            </div>
        </div>

        <!-- Active Courses -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center">
            <div class="p-3 bg-stone-100 rounded-xl mr-4">
                <svg class="w-6 h-6 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <p class="text-stone-400 text-xs font-bold uppercase tracking-widest">Courses</p>
                <p class="text-2xl font-black text-stone-800">42</p>
            </div>
        </div>

        <!-- Fees Status -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center">
            <div class="p-3 bg-green-50 rounded-xl mr-4">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-stone-400 text-xs font-bold uppercase tracking-widest">Fees Status</p>
                <p class="text-2xl font-black text-stone-800">85%</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Activity -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-stone-100">
            <h2 class="text-xl font-black text-stone-800 mb-6 flex items-center">
                <span class="w-2 h-6 bg-gold mr-3 rounded-full"></span>
                Recent Management Activity
            </h2>
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="mt-1 w-2 h-2 rounded-full bg-gold"></div>
                    <div>
                        <p class="text-sm font-bold text-stone-800">Results Published for 200L Computer Science</p>
                        <p class="text-[10px] text-stone-400 uppercase tracking-widest font-bold mt-1">Today, 10:45 AM</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="mt-1 w-2 h-2 rounded-full bg-stone-300"></div>
                    <div>
                        <p class="text-sm font-bold text-stone-800">50 New Student Registrations Verified</p>
                        <p class="text-[10px] text-stone-400 uppercase tracking-widest font-bold mt-1">Yesterday</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-darkblue p-8 rounded-3xl shadow-sm text-white">
            <h2 class="text-xl font-black mb-6">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4">
                <button class="p-4 bg-darkblue-light rounded-xl text-xs font-bold hover:bg-gold hover:text-darkblue transition">Approve Results</button>
                <button class="p-4 bg-darkblue-light rounded-xl text-xs font-bold hover:bg-gold hover:text-darkblue transition">Manage Lecturers</button>
                <button class="p-4 bg-darkblue-light rounded-xl text-xs font-bold hover:bg-gold hover:text-darkblue transition">Fee Reports</button>
                <button class="p-4 bg-darkblue-light rounded-xl text-xs font-bold hover:bg-gold hover:text-darkblue transition">Update Timetable</button>
            </div>
        </div>
    </div>
</div>
 