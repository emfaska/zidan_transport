<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $booking->kode_booking }}</title>
    <style>
        @page { 
            size: A4; 
            margin: 40px; 
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .header-table {
            margin-bottom: 30px;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo-img {
            height: 60px;
            width: auto;
        }
        .company-info {
            text-align: right;
            font-size: 11px;
            color: #666;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #1a237e;
            margin-bottom: 2px;
        }
        .invoice-banner {
            background-color: #f8f9ff;
            text-align: center;
            padding: 15px;
            margin-bottom: 30px;
            border-bottom: 2px solid #1a237e;
        }
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #1a237e;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin: 0;
        }
        .info-grid {
            margin-bottom: 30px;
        }
        .info-grid td {
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        .section-label {
            font-size: 9px;
            font-weight: bold;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .info-box {
            font-size: 12px;
            line-height: 1.6;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid { background-color: #e8f5e9; color: #2e7d32; }
        .status-pending { background-color: #fff8e1; color: #f57f17; }

        .items-table {
            margin-bottom: 40px;
        }
        .items-table th {
            background-color: #1a237e;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 12px;
            vertical-align: top;
        }
        .item-desc strong {
            color: #1a237e;
            display: block;
            margin-bottom: 3px;
        }
        .item-desc small {
            color: #777;
        }

        .summary-wrapper {
            width: 100%;
        }
        .summary-table {
            width: 300px;
            float: right;
        }
        .summary-table td {
            padding: 8px 15px;
            font-size: 12px;
        }
        .summary-label {
            text-align: left;
            color: #666;
        }
        .summary-value {
            text-align: right;
            font-weight: bold;
        }
        .total-row {
            background-color: #1a237e;
            color: white;
        }
        .total-row td {
            padding: 15px !important;
        }
        .total-label {
            font-weight: bold;
            font-size: 13px;
        }
        .total-value {
            font-size: 18px;
            font-weight: bold;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 600px;
            margin-left: -300px;
            margin-top: -50px;
            transform: rotate(-45deg);
            font-size: 120px;
            color: rgba(0,0,0,0.035);
            font-weight: bold;
            text-align: center;
            z-index: -1;
            text-transform: uppercase;
        }

        .footer {
            position: fixed;
            bottom: 30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('images/logo.png');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        }
    @endphp

    @if($booking->status_pembayaran === 'lunas')
        <div class="watermark">LUNAS</div>
    @endif

    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td>
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" class="logo-img" alt="Logo">
                @else
                    <div style="font-size: 24px; font-weight: bold; color: #1a237e;">ZIDAN TRANSPORT</div>
                @endif
            </td>
            <td class="company-info">
                <div class="company-name">{{ \App\Models\Setting::get('site_name', 'Zidan Transport') }}</div>
                {{ \App\Models\Setting::get('contact_address', 'Kediri, Jawa Timur') }}<br>
                WhatsApp: {{ \App\Models\Setting::get('contact_whatsapp_display', '+62 821-4295-1682') }}<br>
                Email: {{ \App\Models\Setting::get('contact_email', 'zidantransport@gmail.com') }}
            </td>
        </tr>
    </table>

    <div class="invoice-banner">
        <h1 class="invoice-title">Invoice Penyeawaan</h1>
    </div>

    <!-- Info Sections -->
    <table class="info-grid">
        <tr>
            <td>
                <div class="section-label">Informasi Pelanggan</div>
                <div class="info-box">
                    <strong>{{ $booking->user->name }}</strong><br>
                    {{ $booking->user->email }}<br>
                    {{ $booking->user->no_hp }}
                </div>
            </td>
            <td style="text-align: right;">
                <div class="section-label">Detail Transaksi</div>
                <div class="info-box">
                    Nomor: <strong>#{{ $booking->kode_booking }}</strong><br>
                    Tanggal: {{ $booking->created_at->format('d/m/Y') }}<br>
                    Status: 
                    <span class="status-badge {{ $booking->status_pembayaran === 'lunas' ? 'status-paid' : 'status-pending' }}">
                        {{ $booking->status_pembayaran === 'lunas' ? 'Lunas' : 'Menunggu Pelunasan' }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <!-- Main Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th width="50%">Deskripsi Perjalanan</th>
                <th width="25%" style="text-align: center;">Armada</th>
                <th width="25%" style="text-align: right;">Jadwal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="item-desc">
                    <strong>{{ $booking->rute->nama_rute }}</strong>
                    <small>Tipe Perjalanan: {{ $booking->tipe_perjalanan === 'round_trip' ? 'Pulang Pergi' : 'Sekali Jalan' }}</small>
                    <small>Jumlah Penumpang: {{ $booking->jumlah_penumpang }} Orang</small>
                </td>
                <td style="text-align: center;">
                    <strong>{{ $booking->armada->nama ?? 'Standar Unit' }}</strong>
                    <small>{{ $booking->armada->nopol ?? '-' }}</small>
                </td>
                <td style="text-align: right;">
                    {{ $booking->tanggal_berangkat->format('d M Y') }}<br>
                    {{ $booking->waktu_jemput->format('H:i') }} WIB
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Summary Section -->
    <div class="summary-wrapper" style="clear: both;">
        <table class="summary-table">
            <tr>
                <td class="summary-label">Biaya Paket</td>
                <td class="summary-value">Rp {{ number_format($booking->harga_paket, 0, ',', '.') }}</td>
            </tr>
            
            @if($booking->harga_tol > 0)
            <tr>
                <td class="summary-label">Biaya Tol</td>
                <td class="summary-value">Rp {{ number_format($booking->harga_tol, 0, ',', '.') }}</td>
            </tr>
            @endif

            @if($booking->potongan_promo > 0)
            <tr>
                <td class="summary-label" style="color: #d32f2f;">Promo Diskon</td>
                <td class="summary-value" style="color: #d32f2f;">- Rp {{ number_format($booking->potongan_promo, 0, ',', '.') }}</td>
            </tr>
            @endif

            @foreach($booking->extensions->where('status', 'approved') as $ext)
            <tr>
                <td class="summary-label">Perpanjangan ({{ $ext->new_return_date->format('d/m') }})</td>
                <td class="summary-value">Rp {{ number_format($ext->additional_price, 0, ',', '.') }}</td>
            </tr>
            @endforeach

            <tr class="total-row">
                <td class="total-label">TOTAL AKHIR</td>
                <td class="total-value">Rp {{ number_format($booking->total_akhir ?? $booking->total_harga, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        &bull; Terima kasih telah memilih Zidan Transport &bull;<br>
        Dokumen ini diterbitkan secara resmi melalui zidantransport.com
    </div>
</body>
</html>
