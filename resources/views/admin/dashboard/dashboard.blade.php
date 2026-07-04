@extends('layouts.admin')

@section('content')
    <!-- Statistics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Total Revenue -->
        <div class="bg-white border border-slate-200 hover:border-indigo-300 p-6 rounded-2xl flex items-center justify-between transition-all duration-300 shadow-sm hover:shadow-md group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Total Revenue</span>
                <h2 class="text-2xl font-black text-slate-800 font-sora">${{ number_format($totalRevenue, 2) }}</h2>
            </div>
            <div class="w-14 h-14 bg-emerald-50 group-hover:bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center text-xl transition-colors duration-250">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
        </div>

        <!-- Card 2: Pending Review -->
        <div class="bg-white border border-slate-200 hover:border-indigo-300 p-6 rounded-2xl flex items-center justify-between transition-all duration-300 shadow-sm hover:shadow-md group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Pending Review</span>
                <h2 class="text-2xl font-black text-slate-800 font-sora">{{ $pendingCount }}</h2>
            </div>
            <div class="w-14 h-14 bg-amber-50 group-hover:bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-xl transition-colors duration-250">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
        </div>

        <!-- Card 3: Approved Sessions -->
        <div class="bg-white border border-slate-200 hover:border-indigo-300 p-6 rounded-2xl flex items-center justify-between transition-all duration-300 shadow-sm hover:shadow-md group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Approved Sessions</span>
                <h2 class="text-2xl font-black text-slate-800 font-sora">{{ $approvedCount }}</h2>
            </div>
            <div class="w-14 h-14 bg-indigo-50 group-hover:bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-xl transition-colors duration-250">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Card 4: Rejected Submissions -->
        <div class="bg-white border border-slate-200 hover:border-indigo-300 p-6 rounded-2xl flex items-center justify-between transition-all duration-300 shadow-sm hover:shadow-md group">
            <div class="space-y-1">
                <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Rejected Reviews</span>
                <h2 class="text-2xl font-black text-slate-800 font-sora">{{ $rejectedCount }}</h2>
            </div>
            <div class="w-14 h-14 bg-red-50 group-hover:bg-red-100 text-red-500 rounded-xl flex items-center justify-center text-xl transition-colors duration-250">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
        </div>
    </div>

    <!-- Charts Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Line Chart -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 text-slate-800 font-semibold font-sora text-sm flex items-center">
                <i class="fa-solid fa-chart-line text-indigo-500 mr-2 text-base"></i> Revenue Trend (Last 15 Days)
            </h5>
            <div class="p-6">
                <div class="h-[300px] w-full relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart for Payment Methods -->
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 text-slate-800 font-semibold font-sora text-sm flex items-center">
                <i class="fa-solid fa-wallet text-amber-500 mr-2 text-base"></i> Payment Methods
            </h5>
            <div class="p-6">
                <div class="h-[300px] w-full relative flex items-center justify-center">
                    <canvas id="paymentMethodChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Bar Chart for Program Stats -->
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 text-slate-800 font-semibold font-sora text-sm flex items-center">
                <i class="fa-solid fa-graduation-cap text-indigo-500 mr-2 text-base"></i> Program Enrollments
            </h5>
            <div class="p-6">
                <div class="h-[250px] w-full relative">
                    <canvas id="programChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table (Streamlined) -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
            <h5 class="px-6 py-4 border-b border-slate-100 flex justify-between items-center text-slate-800 font-semibold font-sora text-sm">
                <span class="flex items-center">
                    <i class="fa-solid fa-clock-rotate-left text-emerald-500 mr-2 text-base"></i> Recent Payment Activities
                </span>
                <a href="{{ route('payment-proofs.index') }}" class="text-xs text-indigo-600 hover:text-indigo-700 hover:underline font-medium">View All Submissions</a>
            </h5>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50 text-slate-500 font-sora text-xs uppercase">
                            <th class="py-3 px-4 font-semibold">Student Name</th>
                            <th class="py-3 px-4 font-semibold">Allocations</th>
                            <th class="py-3 px-4 font-semibold">Amount</th>
                            <th class="py-3 px-4 font-semibold">Status</th>
                            <th class="py-3 px-4 font-semibold text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 bg-white">
                        @forelse($recentSubmissions as $submission)
                            <tr class="hover:bg-slate-50/50 transition-colors duration-150">
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-800">{{ $submission->full_name }}</div>
                                    <span class="text-[10px] text-indigo-600 font-bold font-mono">{{ strtoupper($submission->submission_id) }}</span>
                                    @if($submission->duplicate_submission)
                                        <span class="ml-1 bg-red-50 text-red-500 border border-red-100 text-[9px] px-1 rounded font-bold">Dup</span>
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
                                <td class="py-3.5 px-4 text-slate-800 font-bold">${{ number_format($submission->amount_paid, 2) }}</td>
                                <td class="py-3.5 px-4">
                                    @if($submission->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase">Approved</span>
                                    @elseif($submission->status === 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-100 uppercase">Rejected</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-100 uppercase">Pending</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <div class="inline-flex space-x-1.5">
                                        <a href="{{ route('payment-proofs.show', $submission->id) }}" 
                                           class="p-1.5 bg-slate-50 hover:bg-indigo-50 border border-slate-200 text-xs rounded text-slate-500 hover:text-indigo-600 transition" title="View details">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('payment-proofs.edit', $submission->id) }}" 
                                           class="p-1.5 bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-xs rounded text-slate-500 hover:text-emerald-600 transition" title="Review Submission">
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
            // Chart.js global settings for Light theme
            Chart.defaults.color = '#64748b';
            Chart.defaults.font.family = "'Manrope', sans-serif";
            
            // 1. Revenue Chart (Line Chart)
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            
            // Gradient background for Line Fill (Light Theme)
            const indigoGradient = revenueCtx.createLinearGradient(0, 0, 0, 300);
            indigoGradient.addColorStop(0, 'rgba(99, 102, 241, 0.25)');
            indigoGradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

            const revenueLabels = @json($revenueLabels);
            const revenueValues = @json($revenueValues);

            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: revenueLabels,
                    datasets: [{
                        label: 'Approved Revenue ($)',
                        data: revenueValues,
                        borderColor: '#6366f1',
                        borderWidth: 3,
                        backgroundColor: indigoGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#6366f1',
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
                            grid: { color: '#f1f5f9' },
                            border: { dash: [5, 5] }
                        },
                        y: {
                            grid: { color: '#f1f5f9' },
                            border: { dash: [5, 5] },
                            ticks: {
                                callback: function(value) { return '$' + value; }
                            }
                        }
                    }
                }
            });

            // 2. Payment Method Chart (Doughnut Chart)
            const methodCtx = document.getElementById('paymentMethodChart').getContext('2d');
            const methodLabels = @json($paymentMethodLabels);
            const methodValues = @json($paymentMethodValues);

            new Chart(methodCtx, {
                type: 'doughnut',
                data: {
                    labels: methodLabels,
                    datasets: [{
                        data: methodValues,
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.8)',   // Indigo
                            'rgba(16, 185, 129, 0.8)',   // Emerald
                            'rgba(245, 158, 11, 0.8)',   // Amber
                            'rgba(56, 189, 248, 0.8)'    // Sky Blue
                        ],
                        borderColor: '#ffffff',
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
            const programLabels = @json($programStatsLabels);
            const programValues = @json($programStatsValues);

            new Chart(programCtx, {
                type: 'bar',
                data: {
                    labels: programLabels,
                    datasets: [{
                        label: 'Submissions',
                        data: programValues,
                        backgroundColor: 'rgba(99, 102, 241, 0.7)',
                        borderColor: '#6366f1',
                        borderWidth: 1,
                        borderRadius: 6,
                        hoverBackgroundColor: 'rgba(99, 102, 241, 0.9)'
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
                            grid: { color: '#f1f5f9' },
                            border: { dash: [5, 5] },
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        });
    </script>
@endsection
