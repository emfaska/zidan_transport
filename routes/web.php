<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Root Route - Halaman Landing Page Publik
Route::get('/', function () {
    // Jika sudah login, alihkan ke dashboard masing-masing
    if (Illuminate\Support\Facades\Auth::check()) {
        $user = Illuminate\Support\Facades\Auth::user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'pengemudi') return redirect()->route('driver.dashboard');
        return redirect()->route('home'); // Menuju /home (dashboard pelanggan)
    }

    $armadas = \App\Models\Armada::where('status', 'tersedia')->take(3)->get();
    $layanans = \App\Models\Layanan::where('is_active', true)->take(3)->get();
    $promo = \App\Models\Promo::where('is_active', true)->latest()->first();
    return view('welcome', compact('armadas', 'layanans', 'promo'));
})->name('landing');

// Halaman Master Data (Publik - Bisa Akses Tanpa Login)
Route::get('/armada', function(Illuminate\Http\Request $request) { 
    $query = \App\Models\Armada::where('status', 'tersedia');
    
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('jenis', 'like', '%' . $request->search . '%');
        });
    }

    $armadas = $query->paginate(6)->withQueryString();
    $promo = \App\Models\Promo::where('is_active', true)->latest()->first();
    return view('pelanggan.armada', compact('armadas', 'promo')); 
})->name('pelanggan.armada');

Route::get('/layanan', function() { 
    $layanans = \App\Models\Layanan::where('is_active', true)->get();
    return view('pelanggan.layanan', compact('layanans')); 
})->name('pelanggan.layanan');

Route::get('/rute', function(Illuminate\Http\Request $request) { 
    $query = \App\Models\Rute::where('is_active', true);

    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nama_rute', 'like', '%' . $request->search . '%')
              ->orWhere('lokasi_awal', 'like', '%' . $request->search . '%')
              ->orWhere('tujuan', 'like', '%' . $request->search . '%');
        });
    }

    $rutes = $query->paginate(6)->withQueryString();
    return view('pelanggan.rute', compact('rutes')); 
})->name('pelanggan.rute');

Route::get('/kontak', function() { 
    return view('pelanggan.kontak'); 
})->name('pelanggan.kontak');

// 2. Guest Routes - Hanya bisa diakses jika BELUM login
Route::middleware('guest')->group(function () {
    // Registrasi Pelanggan
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Registrasi Pengemudi Baru
    Route::get('/driver/register', [\App\Http\Controllers\Auth\DriverRegisterController::class, 'showRegistrationForm'])->name('driver.register');
    Route::post('/driver/register', [\App\Http\Controllers\Auth\DriverRegisterController::class, 'register'])->name('driver.register.submit');

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Midtrans Callback (Webhook)
    Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransController::class, 'callback']);
});

// 3. Authenticated Routes - Harus login terlebih dahulu
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [LoginController::class, 'logout']); // Added for easier logout via URL

    // Wilayah KHUSUS ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function() { 
            return view('admin.dashboard'); 
        })->name('admin.dashboard');
        
        // Master Data & Management
        Route::resource('/admin/armada', \App\Http\Controllers\Admin\ArmadaController::class)->names('admin.armada');
        
        Route::resource('/admin/layanan', \App\Http\Controllers\Admin\LayananController::class)->names('admin.layanan');
        Route::patch('/admin/layanan/{layanan}/toggle', [\App\Http\Controllers\Admin\LayananController::class, 'toggleStatus'])->name('admin.layanan.toggle');
        
        Route::resource('/admin/rute', \App\Http\Controllers\Admin\RuteController::class)->names('admin.rute');
        Route::patch('/admin/rute/{rute}/toggle', [\App\Http\Controllers\Admin\RuteController::class, 'toggleStatus'])->name('admin.rute.toggle');
        Route::get('/admin/rute/{rute}/duplicate', [\App\Http\Controllers\Admin\RuteController::class, 'duplicate'])->name('admin.rute.duplicate');
        
        Route::resource('/admin/pelanggan', \App\Http\Controllers\Admin\PelangganController::class)->names('admin.pelanggan');
        Route::resource('/admin/pengemudi', \App\Http\Controllers\Admin\PengemudiController::class)->names('admin.pengemudi');
        Route::patch('/admin/pengemudi/{id}/approve', [\App\Http\Controllers\Admin\PengemudiController::class, 'approve'])->name('admin.pengemudi.approve');
        Route::post('/admin/pengemudi/{id}/reject', [\App\Http\Controllers\Admin\PengemudiController::class, 'reject'])->name('admin.pengemudi.reject');
        
        Route::resource('/admin/booking', \App\Http\Controllers\Admin\BookingController::class)->names('admin.booking');
        Route::get('/admin/booking/{id}/invoice', [\App\Http\Controllers\Admin\BookingController::class, 'downloadInvoice'])->name('admin.booking.invoice');
        Route::post('/admin/booking/{booking}/notify-driver', [\App\Http\Controllers\Admin\BookingController::class, 'notifyDriver'])->name('admin.booking.notify-driver');
        Route::post('/admin/booking/extension/{extension}/handle', [\App\Http\Controllers\Admin\BookingController::class, 'handleExtension'])->name('admin.booking.extension.handle');

        // Refund Management
        Route::get('/admin/refunds', [\App\Http\Controllers\Admin\RefundController::class, 'index'])->name('admin.refund.index');
        Route::patch('/admin/refunds/{id}/approve', [\App\Http\Controllers\Admin\RefundController::class, 'approve'])->name('admin.refund.approve');
        Route::patch('/admin/refunds/{id}/reject', [\App\Http\Controllers\Admin\RefundController::class, 'reject'])->name('admin.refund.reject');

        // Promo Management
        Route::resource('/admin/promo', \App\Http\Controllers\Admin\PromoController::class)->names('admin.promo');
        Route::patch('/admin/promo/{promo}/toggle', [\App\Http\Controllers\Admin\PromoController::class, 'toggleStatus'])->name('admin.promo.toggle');

        // Driver Wallet Management
        Route::get('/admin/wallet', [\App\Http\Controllers\Admin\WalletController::class, 'index'])->name('admin.wallet.index');
        Route::post('/admin/wallet/{id}/approve', [\App\Http\Controllers\Admin\WalletController::class, 'approve'])->name('admin.wallet.approve');
        Route::post('/admin/wallet/{id}/reject', [\App\Http\Controllers\Admin\WalletController::class, 'reject'])->name('admin.wallet.reject');

        // Global Settings Management
        Route::get('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.setting.index');
        Route::patch('/admin/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.setting.update');

        // Business Reports
        Route::get('/admin/reports/export', [\App\Http\Controllers\Admin\ReportController::class, 'exportCsv'])->name('admin.report.export');
        Route::get('/admin/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.report.index');


        // Admin Profile Management
        Route::get('/admin/management', [\App\Http\Controllers\Admin\AdminManagementController::class, 'index'])->name('admin.management.index');
        Route::get('/admin/management/create', [\App\Http\Controllers\Admin\AdminManagementController::class, 'create'])->name('admin.management.create');
        Route::post('/admin/management', [\App\Http\Controllers\Admin\AdminManagementController::class, 'store'])->name('admin.management.store');
    });

    // Wilayah KHUSUS PENGEMUDI
    Route::middleware('role:pengemudi')->group(function () {
        Route::get('/driver/dashboard', [\App\Http\Controllers\Driver\DashboardController::class, 'index'])->name('driver.dashboard');
        Route::post('/driver/status/update', [\App\Http\Controllers\Driver\DashboardController::class, 'updateStatus'])->name('driver.status.update');
        Route::get('/driver/history', [\App\Http\Controllers\Driver\DashboardController::class, 'history'])->name('driver.history');
        Route::get('/driver/order/{id}', [\App\Http\Controllers\Driver\OrderController::class, 'show'])->name('driver.order.show');
        Route::get('/driver/tasks/active', [\App\Http\Controllers\Driver\DashboardController::class, 'activeTasks'])->name('driver.tasks.active');
        Route::post('/driver/order/{id}/status', [\App\Http\Controllers\Driver\OrderController::class, 'updateStatus'])->name('driver.order.update-status');
        Route::get('/driver/wallet', [\App\Http\Controllers\Driver\WalletController::class, 'index'])->name('driver.wallet.index');
        Route::post('/driver/wallet/withdraw', [\App\Http\Controllers\Driver\WalletController::class, 'requestWithdraw'])->name('driver.wallet.withdraw');
        
        // Location Tracking
        Route::post('/driver/location/update', [\App\Http\Controllers\Driver\LocationController::class, 'update'])->name('driver.location.update');


    });

    // Wilayah KHUSUS PELANGGAN
    Route::middleware('role:pelanggan')->group(function () {
        Route::get('/home', function() { 
            // Ambil data armada (maksimal 3 untuk ditampilkan di dashboard)
            $armadas = \App\Models\Armada::where('status', 'tersedia')->latest()->take(3)->get();
            $layanans = \App\Models\Layanan::where('is_active', true)->take(3)->get();
            $promo = \App\Models\Promo::where('is_active', true)->latest()->first();
            $recent_bookings = \App\Models\Booking::where('user_id', \Illuminate\Support\Facades\Auth::id())->with('rute')->latest()->take(2)->get();
            return view('pelanggan.dashboard', compact('armadas', 'layanans', 'promo', 'recent_bookings')); 
        })->name('home');
        
        // Booking System
        Route::get('/booking', [\App\Http\Controllers\Pelanggan\BookingController::class, 'index'])->name('pelanggan.booking.index');
        Route::get('/booking/create', [\App\Http\Controllers\Pelanggan\BookingController::class, 'create'])->name('pelanggan.booking.create');
        Route::post('/booking', [\App\Http\Controllers\Pelanggan\BookingController::class, 'store'])->name('pelanggan.booking.store');
        Route::get('/booking/{id}', [\App\Http\Controllers\Pelanggan\BookingController::class, 'show'])->name('pelanggan.booking.show');
        Route::get('/booking/{id}/payment', [\App\Http\Controllers\Pelanggan\BookingController::class, 'payment'])->name('pelanggan.booking.payment');
        Route::get('/booking/{id}/invoice', [\App\Http\Controllers\Pelanggan\BookingController::class, 'downloadInvoice'])->name('pelanggan.booking.invoice');
        Route::post('/booking/{id}/extension', [\App\Http\Controllers\Pelanggan\BookingController::class, 'requestExtension'])->name('pelanggan.booking.extension');
        
        // Refund System Routes
        Route::get('/booking/{id}/refund', [\App\Http\Controllers\Pelanggan\RefundController::class, 'create'])->name('pelanggan.booking.refund');
        Route::post('/booking/{id}/refund', [\App\Http\Controllers\Pelanggan\RefundController::class, 'store'])->name('pelanggan.booking.refund.store');
        Route::post('/booking/{id}/refund/confirm', [\App\Http\Controllers\Pelanggan\RefundController::class, 'confirm'])->name('pelanggan.booking.refund.confirm');
        
        Route::delete('/booking/{id}', [\App\Http\Controllers\Pelanggan\BookingController::class, 'destroy'])->name('pelanggan.booking.destroy');

        // Route Estimation Search
        Route::post('/rute/cek', [\App\Http\Controllers\Pelanggan\RuteSearchController::class, 'search'])->name('pelanggan.rute.search');

        // Review System
        Route::post('/booking/{id}/review', [\App\Http\Controllers\Pelanggan\ReviewController::class, 'store'])->name('pelanggan.booking.review');

        // Location Tracking Fetch
        Route::get('/booking/{id}/location', [\App\Http\Controllers\Driver\LocationController::class, 'fetch'])->name('pelanggan.booking.location');
    });
    // Profile Management (All Roles)
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');

});

// 4. Webhook Trigger Khusus untuk Cron-Job.org (External Cron)
Route::get('/cron/run-schedule', function () {
    // Mengeksekusi secara terprogram layaknya `php artisan schedule:run` di terminal
    \Illuminate\Support\Facades\Artisan::call('schedule:run');
    
    return response()->json([
        'status' => 'success',
        'message' => 'Laravel Scheduler telah berhasil dieksekusi via Webhook',
        'output' => \Illuminate\Support\Facades\Artisan::output()
    ]);
});