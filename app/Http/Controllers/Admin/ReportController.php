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
        
        // Date range specific for daily reports
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));
        
        // 1. Statistik Utama (Cards)
        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_akhir');
        $totalBookings = Booking::count();
        $completedBookings = Booking::whereIn('status', ['confirmed', 'completed'])->count();
        $totalCustomers = User::where('role', 'pelanggan')->count();

        // 2. Pendapatan Per Bulan (untuk Chart)
        $monthlyRevenue = Booking::whereIn('status', ['confirmed', 'completed'])
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
                $query->whereIn('status', ['confirmed', 'completed']);
            }])
            ->withSum(['assignedBookings as total_revenue' => function($query) {
                $query->whereIn('status', ['confirmed', 'completed']);
            }], 'total_akhir')
            ->orderBy('total_revenue', 'desc')
            ->take(5)
            ->get();

        // 5. Data Transaksi Harian
        $dailyBookings = Booking::with(['user', 'driver', 'rute'])
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.report.index', compact(
            'totalRevenue', 
            'totalBookings', 
            'completedBookings', 
            'totalCustomers',
            'chartData',
            'topRoutes',
            'driverStats',
            'year',
            'startDate',
            'endDate',
            'dailyBookings'
        ));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $bookings = Booking::with(['user', 'driver', 'rute'])
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        $fileName = 'laporan_transaksi_' . $startDate . '_sd_' . $endDate . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = [
            'Kode Booking', 
            'Tanggal Pesan', 
            'Waktu Berangkat', 
            'Pelanggan', 
            'Pengemudi', 
            'Rute', 
            'Status Pesanan', 
            'Status Pembayaran', 
            'Total (Rp)'
        ];

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $b) {
                $row['Kode Booking'] = $b->kode_booking;
                $row['Tanggal Pesan'] = $b->created_at->format('Y-m-d H:i');
                $row['Waktu Berangkat'] = $b->tanggal_berangkat->format('Y-m-d') . ' ' . \Carbon\Carbon::parse($b->waktu_jemput)->format('H:i');
                $row['Pelanggan'] = $b->user->name ?? '-';
                $row['Pengemudi'] = $b->driver->name ?? '-';
                $row['Rute'] = $b->rute->nama_rute ?? '-';
                $row['Status Pesanan'] = strtoupper($b->status);
                $row['Status Pembayaran'] = strtoupper(str_replace('_', ' ', $b->status_pembayaran));
                $row['Total (Rp)'] = $b->total_akhir;

                fputcsv($file, array(
                    $row['Kode Booking'], 
                    $row['Tanggal Pesan'], 
                    $row['Waktu Berangkat'], 
                    $row['Pelanggan'], 
                    $row['Pengemudi'], 
                    $row['Rute'], 
                    $row['Status Pesanan'], 
                    $row['Status Pembayaran'], 
                    $row['Total (Rp)']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
