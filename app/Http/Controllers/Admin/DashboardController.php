<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentProof;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalRevenue = PaymentProof::where('status', PaymentProof::STATUS_APPROVED)->sum('amount_paid');
        $pendingCount = PaymentProof::where('status', PaymentProof::STATUS_PENDING_REVIEW)->count();
        $approvedCount = PaymentProof::where('status', PaymentProof::STATUS_APPROVED)->count();
        $rejectedCount = PaymentProof::where('status', PaymentProof::STATUS_REJECTED)->count();
        $totalSubmissions = PaymentProof::count();

        // Recent Submissions (latest 10)
        $recentSubmissions = PaymentProof::latest()->take(10)->get();

        // Program Stats
        $programStats = PaymentProof::selectRaw('program_id, count(*) as count')
            ->groupBy('program_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $names = [
                    'prog_fullstack_web' => 'Full-Stack Web',
                    'prog_data_analytics' => 'Data Analytics',
                    'prog_uiux_design' => 'UI/UX Design',
                    'prog_mobile_app' => 'Mobile App Dev'
                ];
                $name = $names[$item->program_id] ?? ucwords(str_replace('_', ' ', $item->program_id));
                return [$name => $item->count];
            });

        // Payment Method Stats
        $paymentMethodStats = PaymentProof::selectRaw('payment_method, count(*) as count')
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method');

        // Revenue Trend (Last 15 days of approved payments)
        $revenueTrendData = PaymentProof::where('status', PaymentProof::STATUS_APPROVED)
            ->where('created_at', '>=', now()->subDays(15))
            ->selectRaw('DATE(created_at) as date, SUM(amount_paid) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $revenueLabels = [];
        $revenueValues = [];
        // Fill dates so there are no gaps
        for ($i = 15; $i >= 0; $i--) {
            $dateStr = now()->subDays($i)->format('Y-m-d');
            $labelStr = now()->subDays($i)->format('M d');
            $revenueLabels[] = $labelStr;
            
            $found = $revenueTrendData->firstWhere('date', $dateStr);
            $revenueValues[] = $found ? (float)$found->total : 0.0;
        }

        $data = [
            'heading' => 'Dashboard',
            'title' => 'GMC Session Management Dashboard',
            'active' => 'dashboard',
            'totalRevenue' => $totalRevenue,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
            'totalSubmissions' => $totalSubmissions,
            'recentSubmissions' => $recentSubmissions,
            'programStatsLabels' => $programStats->keys(),
            'programStatsValues' => $programStats->values(),
            'paymentMethodLabels' => $paymentMethodStats->keys(),
            'paymentMethodValues' => $paymentMethodStats->values(),
            'revenueLabels' => $revenueLabels,
            'revenueValues' => $revenueValues,
        ];

        return view('admin.dashboard.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
