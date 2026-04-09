<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));
        
        // 1. Statistik Utama (Cards)
        $totalRevenue = Booking::where('status', 'completed')->sum('total_akhir');
        $totalBookings = Booking::count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $totalCustomers = User::where('role', 'pelanggan')->count();

        // 2. Pendapatan Per Bulan (untuk Chart)
        $monthlyRevenue = Booking::where('status', 'completed')
            ->whereYear('created_at', $year)
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_akhir) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->all();

        // Fill missing months with 0
        $chartData = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartData[] = $monthlyRevenue[$m] ?? 0;
        }

        // 3. Rute Paling Populer
        $topRoutes = Booking::select('rute_id', DB::raw('count(*) as total'))
            ->with('rute')
            ->groupBy('rute_id')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // 4. Performa Driver (Top Earners for Company)
        $driverStats = User::where('role', 'pengemudi')
            ->withCount(['assignedBookings as total_trips' => function($query) {
                $query->where('status', 'completed');
            }])
            ->withSum(['assignedBookings as total_revenue' => function($query) {
                $query->where('status', 'completed');
            }], 'total_akhir')
            ->orderBy('total_revenue', 'desc')
            ->take(5)
            ->get();

        return view('admin.report.index', compact(
            'totalRevenue', 
            'totalBookings', 
            'completedBookings', 
            'totalCustomers',
            'chartData',
            'topRoutes',
            'driverStats',
            'year'
        ));
    }
}
