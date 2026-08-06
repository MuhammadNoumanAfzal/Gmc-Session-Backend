@extends('layouts.admin')

@section('content')
    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 animate-fade-in">
        
        <!-- Card 1: Total Revenue -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 hover:border-gmcGreen/40 dark:hover:border-gmcGreen/30 p-6 rounded-[24px] flex items-center justify-between transition-all duration-300 shadow-sm hover:-translate-y-1 group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-semibold">Total Revenue</span>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white font-sora">PKR {{ number_format($totalRevenue, 2) }}</h2>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Premium payment volume across approved sessions.</p>
            </div>
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-gmcGreen transition-colors group-hover:bg-violet-100 dark:bg-violet-500/15 dark:text-violet-200 dark:group-hover:bg-violet-500/25 text-xl">
                <i class="fa-solid fa-rupee-sign"></i>
            </div>
        </div>

        <!-- Card 2: Pending Review -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 hover:border-gmcBlue/35 dark:hover:border-gmcBlue/30 p-6 rounded-[24px] flex items-center justify-between transition-all duration-300 shadow-sm hover:-translate-y-1 group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-semibold">Pending Review</span>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white font-sora">{{ $pendingCount }}</h2>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Submissions waiting for manual validation.</p>
            </div>
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-fuchsia-50 text-gmcGold transition-colors group-hover:bg-fuchsia-100 dark:bg-fuchsia-500/15 dark:text-fuchsia-200 dark:group-hover:bg-fuchsia-500/25 text-xl">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>

        <!-- Card 3: Approved Sessions -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 hover:border-gmcBlue/35 dark:hover:border-gmcBlue/30 p-6 rounded-[24px] flex items-center justify-between transition-all duration-300 shadow-sm hover:-translate-y-1 group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-semibold">Approved Sessions</span>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white font-sora">{{ $approvedCount }}</h2>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Confirmed enrollments contributing to revenue.</p>
            </div>
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-violet-50 text-gmcBlue transition-colors group-hover:bg-violet-100 dark:bg-violet-500/15 dark:text-violet-200 dark:group-hover:bg-violet-500/25 text-xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Card 4: Rejected Submissions -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 hover:border-red-500/30 dark:hover:border-red-500/30 p-6 rounded-[24px] flex items-center justify-between transition-all duration-300 shadow-sm hover:-translate-y-1 group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-semibold">Rejected Reviews</span>
                <h2 class="text-2xl font-black text-slate-800 dark:text-white font-sora">{{ $rejectedCount }}</h2>
                <p class="text-[11px] text-slate-500 dark:text-slate-400">Items requiring follow-up or resubmission.</p>
            </div>
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-rose-50 text-rose-500 transition-colors group-hover:bg-rose-100 dark:bg-rose-500/15 dark:text-rose-200 dark:group-hover:bg-rose-500/25 text-xl">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
    </div>

    <!-- Charts Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 animate-fade-in delay-100">
        <!-- Revenue Line Chart -->
        <div class="admin-panel admin-glow lg:col-span-2 bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 rounded-[26px] overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 dark:border-violet-500/10 text-slate-800 dark:text-white font-semibold font-sora text-sm flex items-center bg-white/60 dark:bg-white/[0.02]">
                <i class="fa-solid fa-chart-line text-gmcBlue dark:text-violet-200 mr-2 text-base"></i> Revenue Trend (Last 15 Days)
            </h5>
            <div class="p-6">
                <div class="h-[300px] w-full relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart for Payment Methods -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 rounded-[26px] overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 dark:border-violet-500/10 text-slate-800 dark:text-white font-semibold font-sora text-sm flex items-center bg-white/60 dark:bg-white/[0.02]">
                <i class="fa-solid fa-wallet text-gmcGold mr-2 text-base"></i> Payment Methods
            </h5>
            <div class="p-6">
                <div class="h-[300px] w-full relative flex items-center justify-center">
                    <canvas id="paymentMethodChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 animate-fade-in delay-200">
        <!-- Bar Chart for Program Stats -->
        <div class="admin-panel admin-glow bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 rounded-[26px] overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 dark:border-violet-500/10 text-slate-800 dark:text-white font-semibold font-sora text-sm flex items-center bg-white/60 dark:bg-white/[0.02]">
                <i class="fa-solid fa-graduation-cap text-gmcBlue dark:text-violet-200 mr-2 text-base"></i> Program Enrollments
            </h5>
            <div class="p-6">
                <div class="h-[250px] w-full relative">
                    <canvas id="programChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table (Streamlined) -->
        <div class="admin-panel admin-glow lg:col-span-2 bg-white/90 dark:bg-slate-900 border border-slate-200 dark:border-violet-500/10 rounded-[26px] overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 dark:border-violet-500/10 flex justify-between items-center text-slate-800 dark:text-white font-semibold font-sora text-sm bg-white/60 dark:bg-white/[0.02]">
                <span class="flex items-center">
                    <i class="fa-solid fa-clock-rotate-left text-gmcGreen mr-2 text-base"></i> Recent Payment Activities
                </span>
                <a href="{{ route('payment-proofs.index') }}" class="text-xs text-gmcBlue dark:text-violet-200 hover:underline font-bold transition-all">View All Submissions</a>
            </h5>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-slate-150 dark:border-violet-500/10 bg-slate-50 dark:bg-white/[0.03] text-slate-500 dark:text-slate-400 font-sora text-xs uppercase">
                            <th class="py-3 px-4 font-semibold">Student Name</th>
                            <th class="py-3 px-4 font-semibold">Allocations</th>
                            <th class="py-3 px-4 font-semibold">Amount</th>
                            <th class="py-3 px-4 font-semibold">Status</th>
                            <th class="py-3 px-4 font-semibold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-violet-500/10 text-slate-650 dark:text-slate-400 bg-white/70 dark:bg-transparent">
                        @forelse($recentSubmissions as $submission)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-violet-500/[0.06] transition-colors duration-150">
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-800 dark:text-white">{{ $submission->full_name }}</div>
                                    <span class="text-[10px] text-gmcBlue dark:text-violet-200 font-bold font-mono">{{ strtoupper($submission->submission_id) }}</span>
                                    @if($submission->duplicate_submission)
                                        <span class="ml-1 bg-red-50 dark:bg-red-950/20 text-red-550 dark:text-red-400 border border-red-100 dark:border-red-900/30 text-[9px] px-1 rounded font-bold">Dup</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-xs">
                                    @php
                                        $names = [
                                            'prog_fullstack_web' => 'Full-Stack Web',
                                            'prog_data_analytics' => 'Data Analytics',
                                            'prog_uiux_design' => 'UI/UX Design',
                                            'prog_mobile_app' => 'Mobile App Dev'
                                        ];
                                        echo $names[$submission->program_id] ?? ucwords(str_replace('_', ' ', $submission->program_id));
                                    @endphp
                                </td>
                                <td class="py-3.5 px-4 text-slate-800 dark:text-white font-bold">PKR {{ number_format($submission->amount_paid, 2) }}</td>
                                <td class="py-3.5 px-4">
                                    @if($submission->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-violet-50 dark:bg-violet-500/15 text-gmcGreen border border-violet-100 dark:border-violet-400/20 uppercase">Approved</span>
                                    @elseif($submission->status === 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 dark:bg-red-950/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/30 uppercase">Rejected</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-fuchsia-50 dark:bg-fuchsia-500/15 text-gmcGold border border-fuchsia-100 dark:border-fuchsia-400/20 uppercase">Pending</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="inline-flex space-x-1.5">
                                        <a href="{{ route('payment-proofs.show', $submission->id) }}" 
                                           class="p-1.5 bg-slate-50 dark:bg-white/[0.04] hover:bg-violet-50 dark:hover:bg-violet-500/15 border border-slate-200 dark:border-violet-500/10 text-xs rounded text-slate-500 hover:text-gmcBlue dark:hover:text-violet-200 transition" title="View details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('payment-proofs.edit', $submission->id) }}" 
                                           class="p-1.5 bg-slate-50 dark:bg-white/[0.04] hover:bg-violet-50 dark:hover:bg-violet-500/15 border border-slate-200 dark:border-violet-500/10 text-xs rounded text-slate-500 hover:text-gmcGreen dark:hover:text-violet-100 transition" title="Review Submission">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">No recent submissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Inject Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let revenueChart, paymentMethodChart, programChart;

            function initCharts() {
                // Destroy existing charts to prevent overlaps on redraw
                if (revenueChart) revenueChart.destroy();
                if (paymentMethodChart) paymentMethodChart.destroy();
                if (programChart) programChart.destroy();

                const isDark = document.documentElement.classList.contains('dark');
                
                // Color parameters based on active theme
                const gridColor = isDark ? 'rgba(196, 181, 253, 0.10)' : '#e9ddff';
                const labelColor = isDark ? '#b6abd7' : '#6f62a0';
                const primaryAccent = '#8b5cf6';
                const primaryAccentSoft = isDark ? 'rgba(139, 92, 246, 0.34)' : 'rgba(139, 92, 246, 0.18)';
                const secondaryAccent = '#c084fc';
                const accentGold = '#f4c56a';
                const panelBorder = isDark ? '#140f24' : '#ffffff';

                Chart.defaults.color = labelColor;
                Chart.defaults.font.family = "'Manrope', sans-serif";

                // 1. Revenue Chart (Line Chart)
                const revenueCtx = document.getElementById('revenueChart').getContext('2d');
                const lineGradient = revenueCtx.createLinearGradient(0, 0, 0, 300);
                if (isDark) {
                    lineGradient.addColorStop(0, primaryAccentSoft);
                    lineGradient.addColorStop(1, 'rgba(139, 92, 246, 0)');
                } else {
                    lineGradient.addColorStop(0, primaryAccentSoft);
                    lineGradient.addColorStop(1, 'rgba(139, 92, 246, 0)');
                }

                revenueChart = new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: @json($revenueLabels),
                        datasets: [{
                            label: 'Approved Revenue (PKR)',
                            data: @json($revenueValues),
                            borderColor: primaryAccent,
                            borderWidth: 3,
                            backgroundColor: lineGradient,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: primaryAccent,
                            pointBorderColor: '#fff',
                            pointHoverRadius: 7,
                            pointRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { color: gridColor },
                                border: { dash: [5, 5] }
                            },
                            y: {
                                grid: { color: gridColor },
                                border: { dash: [5, 5] },
                                ticks: {
                                    callback: function(value) { return 'PKR ' + value; }
                                }
                            }
                        }
                    }
                });

                // 2. Payment Method Chart (Doughnut Chart)
                const methodCtx = document.getElementById('paymentMethodChart').getContext('2d');
                paymentMethodChart = new Chart(methodCtx, {
                    type: 'doughnut',
                    data: {
                        labels: @json($paymentMethodLabels),
                        datasets: [{
                            data: @json($paymentMethodValues),
                            backgroundColor: [
                                '#8b5cf6',
                                '#c084fc',
                                '#f4c56a',
                                '#ec4899'
                            ],
                            borderColor: panelBorder,
                            borderWidth: 2,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    boxWidth: 10,
                                    usePointStyle: true
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });

                // 3. Enrollment by Program (Bar Chart)
                const programCtx = document.getElementById('programChart').getContext('2d');
                programChart = new Chart(programCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($programStatsLabels),
                        datasets: [{
                            label: 'Submissions',
                            data: @json($programStatsValues),
                            backgroundColor: isDark ? 'rgba(139, 92, 246, 0.72)' : 'rgba(139, 92, 246, 0.82)',
                            borderColor: primaryAccent,
                            borderWidth: 1,
                            borderRadius: 6,
                            hoverBackgroundColor: secondaryAccent
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { display: false }
                            },
                            y: {
                                grid: { color: gridColor },
                                border: { dash: [5, 5] },
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            }

            // Initial Draw
            initCharts();

            // Re-draw when dark/light mode toggle changes
            window.addEventListener('theme-changed', function() {
                initCharts();
            });
        });
    </script>
@endsection
