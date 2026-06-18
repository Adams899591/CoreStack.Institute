<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - CoreStack Institute</title>
    <!-- Tailwind CSS (via CDN for demonstration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <style>
        /* Custom Colors */
        .bg-darkblue { background-color: #1A2B4C; } /* Dark Blue */
        .bg-darkblue-light { background-color: #2A3B5C; } /* Slightly lighter Dark Blue for hover/accents */
        .text-darkblue-light { color: #A7BCCF; } /* Light text on dark blue */
        .border-darkblue-dark { border-color: #0F1E3A; } /* Darker border for dark blue */
        .bg-khaki { background-color: #F0E68C; } /* Light Khaki */
        .text-gold { color: #D4AF37; } /* Gold */
        .bg-gold { background-color: #D4AF37; } /* Gold */
        .border-gold { border-color: #D4AF37; } /* Gold */
        .bg-gold-dark { background-color: #B8860B; } /* Darker Gold for hover/accents */

        /* Custom Scrollbar for Sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #1A2B4C;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #2A3B5C;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }
    </style>

</head>
<body class="bg-stone-100 font-sans antialiased">
    <div x-data="{ sidebarOpen: false, isDesktop: window.innerWidth >= 768 }" @resize.window="isDesktop = window.innerWidth >= 768" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside x-cloak x-show="sidebarOpen || isDesktop"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-darkblue text-white transform transition-transform duration-200 ease-in-out flex flex-col md:relative md:translate-x-0"
               :class="{ '-translate-x-full': !sidebarOpen && !isDesktop, 'translate-x-0': sidebarOpen || isDesktop }"
               @click.away="sidebarOpen = false" {{-- Close sidebar when clicking outside --}}
               >
            <div class="p-8 border-b border-darkblue-dark flex flex-col items-center text-center">
                <span class="text-2xl font-black tracking-tighter text-white uppercase">Web Portal</span> {{-- Main title --}}
                <span class="text-xs font-bold uppercase tracking-widest text-darkblue-light/50 mt-2">CoreStack Academy</span> {{-- Moved CoreStack Academy here --}}
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar"> {{-- Main navigation --}}
                <a href="{{route("std.dashboard")}}" class="{{request()->routeIs("std.dashboard") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate >
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1s 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                <!-- My Program Dropdown -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs(["std.current-semester-reg", "std.previous-registration"]) ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            My Program
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        <a href="{{route("std.current-semester-reg")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate>
                            Current Semester Registration
                        </a>
                        <a href="{{route("std.previous-registration")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate>
                            Previous Registration
                        </a>
                    </div>
                </div>

                <!-- My Results Dropdown -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs("std.student-transcript") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            My Results
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        {{-- <a href="{{route("std.semester-grade")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition">
                            Semester Grades
                        </a> --}}
                        <a href="{{route("std.student-transcript")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate>
                            Transcript
                        </a>
                    </div>
                </div>

                <!-- My Personal Data (Direct Link) -->
                <a href="{{route("std.personal-data")}}" class="{{request()->routeIs("std.personal-data") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Personal Data
                </a>

                <a href="{{route("std.course-catolog")}}" class="{{request()->routeIs("std.course-catolog") ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
                    Course Catalog
                </a>

                <!-- School Fees / Charges Dropdown -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="{{request()->routeIs(["std.current-session-fee", "std.payment-history"]) ? 'flex items-center px-4 py-3 bg-darkblue-light text-gold rounded-lg' : 'flex items-center px-4 py-3 text-darkblue-light hover:bg-darkblue-light hover:text-white rounded-lg transition focus:outline-none'}}" >
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            School Fees
                        </div>
                        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="mt-1 ml-8 space-y-1">
                        <a href="{{route("std.current-session-fee")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate>
                            Current Session Fee
                        </a>
                        <a href="{{route("std.payment-history")}}" class="block px-4 py-2 text-xs text-darkblue-light hover:text-white transition" wire:navigate>
                            Payment History
                        </a>
                    </div>
                </div>
            </nav>

            {{-- User Profile in Sidebar Footer --}}
            <div class="p-4 border-t border-darkblue-dark">
                <div class="flex items-center space-x-3 p-2 rounded-lg bg-khaki/10 border border-gold/20">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=100&h=100&auto=format&fit=crop" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                    <div class="flex-1 text-sm leading-tight">
                        <div class="flex items-center justify-between">
                            <p class="font-medium text-stone-100 text-xs">Usman Adams</p>
                            <button class="text-stone-400 hover:text-gold transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </div>
                        <p class="text-gold text-[10px]">Cyber Security</p>
                    </div>
                </div>
            </div>

        </aside>

        {{-- Mobile Overlay for Sidebar --}}
        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black opacity-50 z-40 md:hidden" @click="sidebarOpen = false"></div>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-stone-200 flex items-center justify-between px-8 shadow-sm">
                <div class="flex items-center">
                    {{-- Hamburger Icon for Mobile --}}
                    <button @click="sidebarOpen = !sidebarOpen" class="text-stone-500 hover:text-gold focus:outline-none md:hidden mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <div class="text-left">
                        <p class="text-sm font-bold text-stone-800 leading-none">Usman Adams</p>
                        <p class="text-[10px] font-semibold text-gold uppercase tracking-tighter mt-1">
                            CSE/2024/31714300 | Web Developer
                        </p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Notification Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="p-2 text-stone-400 hover:text-gold transition relative focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <!-- Red Notification Badge -->
                            <span class="absolute top-1 right-1 flex h-4 w-4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-red-600 text-[10px] text-white items-center justify-center font-bold">5</span>
                            </span>
                        </button>

                        <!-- Dropdown Panel -->
                        <div x-show="open" 
                             @click.away="open = false" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-stone-100 z-50 overflow-hidden">
                            <div class="p-4 border-b border-stone-50 flex justify-between items-center bg-stone-50/50">
                                <h3 class="font-bold text-stone-800 text-sm">Notifications</h3>
                                <span class="text-[10px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-bold uppercase">5 New</span>
                            </div>
                            <div class="max-h-96 overflow-y-auto">
                                <!-- Notification Items -->
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">Course material uploaded</p>
                                    <p class="text-[10px] text-stone-500 mt-1">CSC 301 lecture notes were added 5 minutes ago.</p>
                                </a>
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">Result Published</p>
                                    <p class="text-[10px] text-stone-500 mt-1">Your PHY 202 semester result is now available.</p>
                                    <p class="text-[9px] text-gold font-bold mt-1 uppercase">12 minutes ago</p>
                                </a>
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">Payment Confirmed</p>
                                    <p class="text-[10px] text-stone-500 mt-1">Transaction #CS-991 has been verified successfully.</p>
                                    <p class="text-[9px] text-stone-400 mt-1 uppercase">1 hour ago</p>
                                </a>
                                <a href="#" class="block p-4 hover:bg-stone-50 transition border-b border-stone-50">
                                    <p class="text-xs text-stone-800 font-semibold">Timetable Update</p>
                                    <p class="text-[10px] text-stone-500 mt-1">The mid-semester exam date has been shifted.</p>
                                    <p class="text-[9px] text-stone-400 mt-1 uppercase">3 hours ago</p>
                                </a>
                            </div>
                            <a href="#" class="block p-3 text-center text-xs font-bold text-gold hover:bg-stone-50 transition">
                                View All Notifications
                            </a>
                        </div>
                    </div>
                    <div class="h-8 w-[1px] bg-stone-200"></div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8">
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