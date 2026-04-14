@extends('layouts.admin')

@section('title', 'Laporan Bisnis')
@section('header_title', 'Laporan & Analitik')

@section('content')
<div class="space-y-8">
    <!-- Filter -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <form action="{{ route('admin.report.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
            <select name="year" class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-[#1a237e] focus:outline-none shadow-sm">
                @for($y = date('Y'); $y >= 2024; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>Tahun {{ $y }}</option>
                @endfor
            </select>
            <input type="date" name="start_date" value="{{ $startDate }}" class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-[#1a237e] focus:outline-none shadow-sm" title="Mulai Tanggal">
            <span class="text-xs font-bold text-gray-400">s/d</span>
            <input type="date" name="end_date" value="{{ $endDate }}" class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-bold text-[#1a237e] focus:outline-none shadow-sm" title="Sampai Tanggal">
            <button type="submit" class="p-2.5 bg-[#1a237e] text-white rounded-xl hover:bg-blue-800 transition shadow-lg text-xs font-bold">
                <i class="bi bi-filter"></i> Filter
            </button>
        </form>
        <div class="flex gap-2">
            <a href="{{ route('admin.report.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="px-4 py-2.5 bg-green-500 text-white rounded-xl text-xs font-black hover:bg-green-600 transition shadow-sm flex items-center gap-2">
                <i class="bi bi-file-earmark-excel"></i> Export CSV
            </a>
            <button onclick="window.print()" class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-xs font-black text-gray-500 hover:text-[#1a237e] transition shadow-sm flex items-center gap-2">
                <i class="bi bi-printer"></i> Cetak PDF
            </button>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Omzet</p>
            <h3 class="text-2xl font-black text-[#1a237e] relative z-10">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <p class="text-[9px] text-green-500 font-bold mt-2 flex items-center gap-1">
                <i class="bi bi-graph-up-arrow"></i> Selesai
            </p>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Booking</p>
            <h3 class="text-2xl font-black text-[#1a237e] relative z-10">{{ number_format($totalBookings, 0, ',', '.') }}</h3>
            <p class="text-[9px] text-blue-500 font-bold mt-2">Semua Status</p>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-yellow-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Success Rate</p>
            @php $rate = $totalBookings > 0 ? ($completedBookings / $totalBookings) * 100 : 0; @endphp
            <h3 class="text-2xl font-black text-[#1a237e] relative z-10">{{ number_format($rate, 1) }}%</h3>
            <div class="w-full bg-gray-100 h-1.5 rounded-full mt-3">
                <div class="bg-[#fbc02d] h-full rounded-full" style="width: {{ $rate }}%"></div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full opacity-50 group-hover:scale-110 transition-transform"></div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Pelanggan</p>
            <h3 class="text-2xl font-black text-[#1a237e] relative z-10">{{ number_format($totalCustomers, 0, ',', '.') }}</h3>
            <p class="text-[9px] text-purple-500 font-bold mt-2 uppercase">User Terdaftar</p>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-xl font-black text-[#1a237e] uppercase tracking-tight">Grafik Pendapatan</h3>
                <p class="text-xs font-bold text-gray-400 tracking-widest uppercase">Tahun {{ $year }}</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-[#1a237e]"></span>
                <span class="text-[10px] font-black text-gray-400 uppercase">Omzet Selesai</span>
            </div>
        </div>
        <div class="h-[350px]">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Top Routes -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-sm">Rute Terpopuler</h3>
                <i class="bi bi-map text-gray-300 text-xl"></i>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    @forelse($topRoutes as $route)
                    <div class="flex justify-between items-center group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-[#1a237e] font-black text-sm group-hover:bg-[#1a237e] group-hover:text-white transition-all">
                                {{ $loop->iteration }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-[#1a237e] uppercase tracking-tight">{{ $route->rute->nama_rute ?? 'N/A' }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">{{ $route->rute->jarak ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-[#1a237e]">{{ $route->total }} Trip</p>
                            <div class="w-24 h-1 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                @php $max = $topRoutes->first()->total ?? 1; @endphp
                                <div class="bg-[#fbc02d] h-full" style="width: {{ ($route->total / $max) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 py-4 italic text-sm">Belum ada data rute.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Driver Performance -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-gray-50/30 flex justify-between items-center">
                <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-sm">Performa Driver Terbaik</h3>
                <i class="bi bi-star-fill text-[#fbc02d] text-xl"></i>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    @forelse($driverStats as $stat)
                    <div class="flex justify-between items-center group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-white shadow-md">
                                <img src="{{ $stat->foto_profil ? asset('storage/' . $stat->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($stat->name).'&background=1a237e&color=fff&bold=true' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-sm font-black text-[#1a237e] uppercase tracking-tight">{{ $stat->name }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">{{ $stat->total_trips }} Pesanan Selesai</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-gray-400 uppercase leading-none mb-1">Total Omzet</p>
                            <p class="text-sm font-black text-green-600">Rp {{ number_format($stat->total_revenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-gray-400 py-4 italic text-sm">Belum ada data driver.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Transaksi Harian -->
    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden mt-8">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <div>
                <h3 class="font-black text-[#1a237e] uppercase tracking-widest text-sm">Data Transaksi Spesifik</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase mt-1">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
            </div>
            <i class="bi bi-table text-gray-300 text-xl"></i>
        </div>
        <div class="p-8 overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">
                        <th class="pb-4">No</th>
                        <th class="pb-4">Tgl. Berangkat</th>
                        <th class="pb-4">Pelanggan</th>
                        <th class="pb-4">Driver</th>
                        <th class="pb-4">Total (Rp)</th>
                        <th class="pb-4">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($dailyBookings as $booking)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="py-4 font-bold text-[#1a237e]">{{ $loop->iteration }}</td>
                        <td class="py-4">
                            <p class="font-bold text-[#1a237e]">{{ $booking->tanggal_berangkat->format('d M Y') }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ \Carbon\Carbon::parse($booking->waktu_jemput)->format('H:i') }} WIB</p>
                        </td>
                        <td class="py-4 font-bold text-[#1a237e]">{{ $booking->user->name ?? '-' }}</td>
                        <td class="py-4 font-bold text-[#1a237e]">{{ $booking->driver->name ?? '-' }}</td>
                        <td class="py-4 font-black text-green-600">{{ number_format($booking->total_akhir, 0, ',', '.') }}</td>
                        <td class="py-4">
                            @if($booking->status === 'completed')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-lg text-[9px] font-black uppercase">Selesai</span>
                            @elseif($booking->status === 'confirmed')
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-lg text-[9px] font-black uppercase">Dikonfirmasi</span>
                            @elseif($booking->status === 'cancelled')
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-lg text-[9px] font-black uppercase">Batal</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-[9px] font-black uppercase">{{ $booking->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400 text-sm font-bold">Tidak ada transaksi pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('turbo:load', () => {
        const canvas = document.getElementById('revenueChart');
        if (!canvas) return;

        // Destroy previous instance to prevent "Canvas is already in use" error from Chart.js with Turbo
        if (window.revenueChartInstance) {
            window.revenueChartInstance.destroy();
        }

        const ctx = canvas.getContext('2d');
        
        // Create Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(26, 35, 126, 0.2)');
        gradient.addColorStop(1, 'rgba(26, 35, 126, 0.0)');

        window.revenueChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartData) !!},
                    borderColor: '#1a237e',
                    borderWidth: 4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#1a237e',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    fill: true,
                    backgroundColor: gradient,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1a237e',
                        titleFont: { size: 12, weight: 'bold', family: 'Montserrat' },
                        bodyFont: { size: 14, weight: 'bold', family: 'Montserrat' },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: {
                            font: { size: 10, weight: 'bold', family: 'Montserrat' },
                            color: '#94a3b8',
                            callback: function(value) {
                                if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'M';
                                if (value >= 1000) return 'Rp ' + (value / 1000) + 'K';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10, weight: 'bold', family: 'Montserrat' },
                            color: '#94a3b8'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
