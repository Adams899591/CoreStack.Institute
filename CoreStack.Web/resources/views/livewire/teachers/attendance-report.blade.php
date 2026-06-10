<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-stone-800 tracking-tight">Course Performance Analytics</h1>
            <p class="text-sm text-stone-500 font-medium">Monitor attendance trends across all your active courses.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 bg-white border border-stone-200 text-stone-700 rounded-lg text-sm font-bold hover:bg-stone-50 transition flex items-center">
                <svg class="w-4 h-4 mr-2 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M6 7h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V9a2 2 0 012-2zm0 0h12"></path></svg>
                Filter Period
            </button>
            <button class="px-4 py-2 bg-darkblue text-white rounded-lg text-sm font-bold hover:bg-darkblue-light transition shadow-sm flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Full Report
            </button>
        </div>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Average Attendance</p>
            <div class="flex items-end justify-between mt-2">
                <h2 class="text-3xl font-black text-darkblue">84.2%</h2>
                <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-md">+2.5% vs last week</span>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Total Active Courses</p>
            <div class="mt-2">
                <h2 class="text-3xl font-black text-darkblue">4</h2>
                <p class="text-xs text-stone-500 mt-1">Across Science & Engineering</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
            <p class="text-[10px] font-bold text-stone-400 uppercase tracking-widest">Attendance Status</p>
            <div class="flex items-center gap-4 mt-2">
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-gold mr-2"></span>
                    <span class="text-xs font-bold text-stone-600">Present</span>
                </div>
                <div class="flex items-center">
                    <span class="w-3 h-3 rounded-full bg-stone-200 mr-2"></span>
                    <span class="text-xs font-bold text-stone-600">Absent</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Visual Chart Section (Bar Chart) -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100">
        <h3 class="font-bold text-stone-800 mb-6">Average Attendance by Course (%)</h3>
        <div class="h-64" x-data="{
            init() {
                new Chart(this.$refs.canvas, {
                    type: 'bar',
                    data: {
                        labels: ['CSC 301', 'MAT 102', 'PHY 201', 'ENG 101'],
                        datasets: [{
                            data: [85, 70, 92, 78],
                            backgroundColor: '#1A2B4C', // CoreStack Primary Blue
                            hoverBackgroundColor: '#D4AF37', // CoreStack Gold
                            borderRadius: 6,
                            borderSkipped: false,
                            barThickness: 32
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { 
                                backgroundColor: '#1A2B4C',
                                callbacks: { label: (ctx) => ' ' + ctx.raw + '% Attendance' } 
                            }
                        },
                        scales: {
                            y: { 
                                beginAtZero: true, 
                                max: 100,
                                grid: { color: '#f5f5f4', drawTicks: false },
                                border: { display: false },
                                ticks: { color: '#a8a29e', font: { size: 10, weight: 'bold' } }
                            },
                            x: { 
                                grid: { display: false }, 
                                border: { display: false },
                                ticks: { color: '#a8a29e', font: { size: 10, weight: 'bold' } }
                            }
                        }
                    }
                })
            }
        }">
            <canvas x-ref="canvas"></canvas>
        </div>
    </div>

    @once
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endonce

    <!-- Student Attendance List -->
    <div class="bg-white rounded-p 2xl shadow-sm border border-stone-100 overflow-hidden">
        <div class="p-6 border-b border-stone-100 flex justify-between items-center">
            <h3 class="font-bold text-stone-800 uppercase text-xs tracking-widest">Course Breakdown</h3>
            <div class="text-[10px] font-bold text-gold bg-khaki/10 px-3 py-1 rounded-full border border-gold/10">
                Academic Semester: 2023/2024
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-stone-50/50">
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase">Course Code & Title</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase text-center">Enrolled Students</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase">Avg. Attendance</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-stone-400 uppercase text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @foreach([['code' => 'CSC 301', 'name' => 'Software Engineering'], ['code' => 'MAT 102', 'name' => 'Linear Algebra'], ['code' => 'PHY 201', 'name' => 'General Physics II']] as $course)
                    <tr class="hover:bg-stone-50/30 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center text-darkblue text-[10px] font-black mr-3">
                                    {{ $course['code'] }}
                                </div>
                                <p class="text-sm font-bold text-stone-800">{{ $course['name'] }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-medium text-stone-600">45 Students</td>
                        <td class="px-6 py-4">
                            <div class="w-full bg-stone-100 h-1.5 rounded-full overflow-hidden max-w-[100px]">
                                <div class="bg-gold h-full" style="width: 90%"></div>
                            </div>
                            <span class="text-[10px] font-bold text-stone-500 mt-1 block">90% Attendance</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button title="Download Individual Receipt" class="p-2 text-stone-400 hover:text-darkblue transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
