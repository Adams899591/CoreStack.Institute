 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal - CoreStack Institute</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    @livewireStyles
    <style>
        .bg-darkblue { background-color: #1A2B4C; }
        .bg-darkblue-light { background-color: #2A3B5C; }
        .text-darkblue-light { color: #A7BCCF; }
        .border-darkblue-dark { border-color: #0F1E3A; }
        .bg-khaki { background-color: #F0E68C; }
        .text-gold { color: #D4AF37; }
        .bg-gold { background-color: #D4AF37; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1A2B4C; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #2A3B5C; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #D4AF37; }
    </style>
</head>
<body class="bg-stone-100 font-sans antialiased">
    <div x-data="{ sidebarOpen: false, isDesktop: window.innerWidth >= 768 }" @resize.window="isDesktop = window.innerWidth >= 768" class="flex h-screen overflow-hidden">
        
        
        <!-- Sidebar -->
        <aside x-cloak x-show="sidebarOpen || isDesktop"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-darkblue text-white transform transition-transform duration-200 ease-in-out flex flex-col md:relative md:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen && !isDesktop, 'translate-x-0': sidebarOpen || isDesktop }"
               @click.away="sidebarOpen = false">
            <div class="p-8 border-b border-darkblue-dark flex flex-col items-center text-center">
                <span class="text-2xl font-black tracking-tighter text-white uppercase">TCHR Portal</span>
                <span class="text-xs font-bold uppercase tracking-widest text-darkblue-light/50 mt-2">CoreStack Academy</span>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{route("tchr.dashboard")}}"  class="{{request()->routeIs("tchr.dashboard") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <!-- Academic Management -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs(["tchr.course-list", "tchr.lecture-materials"]) ? 'w-full flex items-center justify-between px-4 py-3 bg-darkblue-light text-gold   rounded-lg transition focus:outline-none' : 'w-full flex items-center justify-between px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            My Courses
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        <a href="{{route("tchr.course-list")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition"  wire:navigate >Course List</a>
                        <a href="{{route("tchr.lecture-materials")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition"  wire:navigate >Lecture Materials</a>
                    </div>
                </div>

                <!-- Students & Grading -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs(["tchr.grade-entry", "tchr.grade-entry"]) ? 'w-full flex items-center justify-between px-4 py-3 bg-darkblue-light text-gold   rounded-lg transition focus:outline-none' : 'w-full flex items-center justify-between px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Students
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        <a href="{{route("tchr.grade-entry")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition"  wire:navigate >Grade Entry</a>
                        {{-- <a href="{{route("")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition"  wire:navigate >Result Approval</a> --}}
                    </div>
                </div>

                <a href="{{route("tchr.assignments")}}" class="{{request()->routeIs("tchr.assignments") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M6 7h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2zm0 0h12"></path></svg>
                    Assignments
                </a>

                <!-- Reports -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs(["tchr.attendance-tracker", "tchr.attendance-report"]) ? 'w-full flex items-center justify-between px-4 py-3 bg-darkblue-light text-gold   rounded-lg transition focus:outline-none' : 'w-full flex items-center justify-between px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Reports
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        <a href="{{route("tchr.attendance-tracker")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition"  wire:navigate >Attendance Tracker</a>
                        <a href="{{route("tchr.attendance-report")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate >Attendance Report</a>
                    </div>
                </div>

                <a href="{{route("tchr.teacher-profile")}}" class="{{request()->routeIs("tchr.teacher-profile") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Profile
                </a>
            </nav>

            <div class="p-4 border-t border-darkblue-dark">
                <div class="flex items-center space-x-3 p-2 rounded-lg bg-khaki/10 border border-gold/20">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=100&h=100&auto=format&fit=crop" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <div class="flex-1 text-sm leading-tight">
                        <div class="flex items-center justify-between">
                            <p class="font-medium text-stone-100 text-xs">Dr. Usman Adams</p>
                            <button class="text-stone-400 hover:text-gold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </div>
                        <p class="text-gold text-[10px]">Senior Lecturer</p>
                    </div>
                </div>
            </div>
        </aside>

       <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- header --}}
            <header class="h-16 bg-white border-b border-stone-200 flex items-center justify-between px-8 shadow-sm">

                {{-- Main header --}}
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-stone-500 hover:text-gold md:hidden mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="text-left">
                        <p class="text-sm font-bold text-stone-800 leading-none">Dr. Usman Adams</p>
                        <p class="text-[10px] font-semibold text-gold uppercase tracking-tighter mt-1">Faculty of Computer Science</p>
                    </div>
                </div>

                {{-- Notification --}}
                <div class="flex items-center space-x-4">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="p-2 text-stone-400 hover:text-gold transition relative focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-1 right-1 flex h-4 w-4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-red-600 text-[10px] text-white items-center justify-center font-bold">3</span>
                            </span>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-stone-100 z-50 overflow-hidden">
                            <div class="p-4 border-b border-stone-50 bg-stone-50/50 flex justify-between items-center">
                                <h3 class="font-bold text-stone-800 text-sm">Staff Notifications</h3>
                                <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">3 New</span>
                            </div>
                            <div class="max-h-96 overflow-y-auto text-left">
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">New Student Enrollment</p>
                                    <p class="text-[10px] text-stone-500 mt-1">15 new students have joined CSC 301.</p>
                                </a>
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">Faculty Meeting</p>
                                    <p class="text-[10px] text-stone-500 mt-1">The board meeting is scheduled for Friday at 10 AM.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="h-8 w-[1px] bg-stone-200"></div>
                </div>

            </header>

        
            <main class="flex-1 overflow-y-auto p-8 bg-stone-50">
                {{ $slot }}
            </main>

            {{-- footer --}}
            <footer class="h-16 bg-white border-t border-stone-200 flex items-center justify-between px-8 shadow-sm">
                <div class="text-stone-500 text-xs font-medium italic">
                    &copy; {{ date('Y') }} CoreStack Institute - Academic Portal
                </div>
                <div class="flex items-center space-x-6">
                    <nav class="flex items-center space-x-4">
                        <a href="#" class="text-[10px] font-bold text-stone-400 hover:text-gold uppercase tracking-widest transition">Policy</a>
                        <a href="#" class="text-[10px] font-bold text-stone-400 hover:text-gold uppercase tracking-widest transition">Support</a>
                    </nav>
                </div>
            </footer>

        </div>
    </div>
    @livewireScripts
</body>
</html> 