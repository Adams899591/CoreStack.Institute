<div class="space-y-6">
    <!-- Profile Header Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-stone-100 overflow-hidden relative">
        <div class="h-32 bg-darkblue w-full"></div>
        <div class="px-8 pb-8 flex flex-col md:flex-row items-center md:items-end gap-6 -mt-12">
            <div class="w-32 h-32 rounded-full border-4 border-white bg-stone-100 overflow-hidden shadow-sm relative group">
                 <img src="https://ui-avatars.com/api/?name=Teacher+Name&background=D4AF37&color=fff" alt="Profile" class="w-full h-full object-cover">
                 <button class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                 </button>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-2xl font-black text-stone-800 tracking-tight leading-none">Dr. Alexander Sterling</h1>
                <p class="text-gold font-bold uppercase text-[10px] tracking-[0.2em] mt-2">Senior Lecturer • Faculty of Computing</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-2 mt-4">
                    <span class="px-3 py-1 bg-stone-50 text-stone-500 text-[10px] font-bold rounded-full border border-stone-100 uppercase">ID: CS-TEA-2024</span>
                    <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full border border-green-100 uppercase italic">Status: Active</span>
                </div>
            </div>
            <div class="flex gap-2">
                <button class="px-5 py-2.5 bg-darkblue text-white rounded-xl text-xs font-bold hover:opacity-90 transition shadow-md flex items-center">
                    <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Profile
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <!-- Left Sidebar: Personal Info -->
        <div class="md:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-2xl border border-stone-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-5 border-b border-stone-50 pb-2">Quick Stats</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-stone-50/50 p-4 rounded-xl border border-stone-50">
                        <p class="text-[9px] font-bold text-stone-400 uppercase">Courses</p>
                        <h4 class="text-xl font-black text-darkblue">08</h4>
                    </div>
                    <div class="bg-stone-50/50 p-4 rounded-xl border border-stone-50">
                        <p class="text-[9px] font-bold text-stone-400 uppercase">Students</p>
                        <h4 class="text-xl font-black text-darkblue">450+</h4>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-5 border-b border-stone-50 pb-2">Contact Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-stone-50 flex items-center justify-center text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-stone-400 uppercase">Work Email</p>
                            <p class="text-sm font-bold text-stone-800">a.sterling@corestack.edu</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-stone-50 flex items-center justify-center text-stone-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold text-stone-400 uppercase">Office Location</p>
                            <p class="text-sm font-bold text-stone-800">Lagos Campus, Room 402</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Professional Details -->
        <div class="md:col-span-8 space-y-6">
            <div class="bg-white p-8 rounded-2xl border border-stone-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-4">Professional Biography</h3>
                <p class="text-stone-600 text-sm leading-relaxed">
                    Expert in systems architecture and distributed computing with over a decade of teaching experience. I focus on developing intuitive learning pathways for complex technical subjects, specifically in the realms of Software Engineering and Cybersecurity. I believe in a hands-on, project-based approach to technical education.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-stone-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-6">Academic Background</h3>
                <div class="space-y-6">
                    <div class="relative pl-6 border-l-2 border-stone-100">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-darkblue border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-gold uppercase">Doctorate Degree</p>
                        <h4 class="text-sm font-bold text-stone-800">Ph.D. in Computer Science</h4>
                        <p class="text-xs text-stone-500 font-medium">University of Lagos, 2018</p>
                    </div>
                    <div class="relative pl-6 border-l-2 border-stone-100">
                        <div class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-stone-200 border-4 border-white shadow-sm"></div>
                        <p class="text-[10px] font-bold text-gold uppercase">Master's Degree</p>
                        <h4 class="text-sm font-bold text-stone-800">M.Sc. Information Technology</h4>
                        <p class="text-xs text-stone-500 font-medium">Covenant University, 2012</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl border border-stone-100 shadow-sm">
                <h3 class="text-[10px] font-bold text-stone-400 uppercase tracking-widest mb-6">Expertise & Specialization</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(['Software Engineering', 'System Architecture', 'Cloud Computing', 'Cybersecurity', 'Algorithm Design', 'Machine Learning'] as $skill)
                        <span class="px-4 py-2 bg-stone-50 text-stone-600 text-[10px] font-bold rounded-lg border border-stone-100 uppercase tracking-tighter hover:bg-darkblue hover:text-white transition cursor-default">
                            {{ $skill }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
