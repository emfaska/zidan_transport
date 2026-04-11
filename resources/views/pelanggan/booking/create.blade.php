<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Perjalanan - Zidan Transport</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mont { font-family: 'Montserrat', sans-serif; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-up { animation: fadeInUp 0.4s ease forwards; }
        
        /* Custom toggle styling */
        .type-toggle-btn { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .type-toggle-active { 
            background-color: #1a237e; 
            color: white; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); 
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased overflow-x-hidden">

    <!-- Navbar/Back Header -->
    <div class="fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md border-b border-slate-100 p-4 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-xl text-xs font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50 transition-all group">
                <i class="bi bi-arrow-left group-hover:-translate-x-1"></i> Kembali
            </a>
            <div class="hidden md:flex flex-col items-end">
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-[0.3em]">Step 01 / 02</span>
                <span class="text-[10px] font-bold text-[#1a237e] uppercase tracking-widest leading-none mt-1">Konfigurasi Pesanan</span>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 pt-24 pb-20 relative">
        <!-- Header Section -->
        <div class="max-w-4xl mb-8 animate-up">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#fbc02d]/10 rounded-full border border-[#fbc02d]/20 mb-3 text-[#1a237e]">
                <span class="w-1.5 h-1.5 rounded-full bg-[#fbc02d] animate-pulse"></span>
                <span class="text-[8px] font-black uppercase tracking-widest">Layanan Premium</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-mont font-[900] text-[#1a237e] uppercase tracking-tighter leading-none mb-2">
                Pesan <span class="text-[#fbc02d]">Perjalanan</span>
            </h1>
            <p class="text-slate-500 text-sm font-medium leading-relaxed">Silakan lengkapi detail rute dan pilih armada yang sesuai dengan kebutuhan Anda.</p>
        </div>

        <form action="{{ route('pelanggan.booking.store') }}" method="POST" id="mainBookingForm">
            @csrf
            <input type="hidden" name="armada_id" value="{{ request('armada_id') }}">
            <input type="hidden" name="rute_id" id="rute_id_hidden">
            <input type="hidden" name="tipe_perjalanan" id="tipe_perjalanan_hidden" value="one_way">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- FORM COLUMN -->
                <div class="lg:col-span-8 space-y-6 animate-up" style="animation-delay: 0.1s">
                    
                    <!-- 1. Rute & Waktu -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                            <span class="w-6 h-1 bg-[#fbc02d] rounded-full"></span> 01. Rute & Waktu
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Layanan Perjalanan</label>
                                <select name="layanan_id" id="layanan_id" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400 outline-none transition-all">
                                    <option value="" disabled selected>Pilih Layanan</option>
                                    @foreach($layanans as $layanan)
                                        <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Kota Tujuan</label>
                                <select id="tujuan_select" required disabled class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold disabled:opacity-50">
                                    <option value="" disabled selected>Pilih Layanan Dahulu...</option>
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Tanggal Berangkat</label>
                                <input type="date" name="tanggal_berangkat" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Waktu Penjemputan</label>
                                <input type="time" name="waktu_jemput" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold">
                            </div>
                        </div>
                    </div>

                    <!-- 2. Lokasi Detail -->
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100">
                        <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                            <span class="w-6 h-1 bg-[#fbc02d] rounded-full"></span> 02. Detail Alamat
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Titik Penjemputan</label>
                                <input type="text" name="titik_jemput" id="titik_jemput" placeholder="Contoh: Jl. Sudirman No. 10" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Titik Tujuan/Penurunan</label>
                                <input type="text" name="titik_tujuan" id="titik_tujuan" placeholder="Contoh: Bandara Juanda T1" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold">
                            </div>
                            <div class="md:col-span-2 space-y-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase ml-2 tracking-widest">Jumlah Penumpang</label>
                                <input type="number" name="jumlah_penumpang" value="1" min="1" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-sm font-bold">
                            </div>
                        </div>
                    </div>

                    <!-- 3. Pilih Paket (Dynamic Grid) -->
                    <div id="armada_section" class="hidden">
                        <div class="flex justify-between items-center mb-4 px-2">
                            <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] flex items-center gap-3">
                                <span class="w-6 h-1 bg-[#fbc02d] rounded-full"></span> 03. Pilih Armada & Tipe Trip
                            </h3>
                        </div>
                        <div id="armada_grid" class="grid grid-cols-1 md:grid-cols-2 gap-4 px-1">
                            <!-- JS Inject -->
                        </div>
                    </div>

                    <!-- 4. Informasi Biaya (RESTORED & UPDATED) -->
                    <div class="bg-indigo-50/40 rounded-[32px] p-6 border border-indigo-100/50">
                         <h3 class="text-[10px] font-black text-[#1a237e] uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                            <i class="bi bi-info-circle-fill text-blue-600"></i> Ketentuan Tarif
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Included List -->
                            <div class="flex gap-4">
                               <div class="w-10 h-10 rounded-2xl bg-green-100 flex items-center justify-center shrink-0 shadow-sm shadow-green-100/50">
                                   <i class="bi bi-shield-check text-green-600 text-lg"></i>
                               </div>
                               <div class="space-y-3">
                                   <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest leading-none">Sudah Termasuk (Included):</p>
                                   <ul class="space-y-1.5">
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-check2 text-green-500 font-bold"></i> Unit Armada Premium
                                       </li>
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-check2 text-green-500 font-bold"></i> Driver Profesional
                                       </li>
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-check2 text-green-500 font-bold"></i> Bahan Bakar (BBM)
                                       </li>
                                   </ul>
                               </div>
                            </div>
                            <!-- Excluded List -->
                            <div class="flex gap-4 border-t border-indigo-100 md:border-t-0 md:border-l md:pl-8 pt-6 md:pt-0">
                               <div class="w-10 h-10 rounded-2xl bg-red-100 flex items-center justify-center shrink-0 shadow-sm shadow-red-100/50">
                                   <i class="bi bi-exclamation-circle text-red-600 text-lg"></i>
                               </div>
                               <div class="space-y-3">
                                   <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest leading-none">Belum Termasuk (Excluded):</p>
                                   <ul class="space-y-1.5">
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-x text-red-400 font-bold"></i> Biaya Jalan Tol & Parkir
                                       </li>
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-x text-red-400 font-bold"></i> Makan Driver
                                       </li>
                                       <li class="flex items-center gap-2 text-[11px] text-slate-600 font-medium">
                                           <i class="bi bi-x text-red-400 font-bold"></i> Penginapan Driver (Jika Menginap)
                                       </li>
                                   </ul>
                               </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Opsi Layanan Tambahan (Tol) -->
                    <div id="tol-section" class="hidden">
                        <label class="flex items-center gap-4 p-5 rounded-3xl bg-white border border-slate-100 shadow-sm cursor-pointer hover:bg-slate-50 transition-all border-l-4 border-l-blue-600">
                            <input type="checkbox" name="include_tol" id="include_tol" value="1" class="h-6 w-6 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            <div class="flex-grow">
                                <p class="text-sm font-black text-[#1a237e] uppercase tracking-tighter">Lewat Jalan Tol</p>
                                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Estimasi waktu sampai lebih cepat</p>
                            </div>
                            <span class="text-xs font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg" id="tol-price-display">+Rp 0</span>
                        </label>
                    </div>

                    <!-- 6. Catatan Khusus -->
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="bg-slate-50 px-6 py-2 border-b border-slate-100">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Catatan Tambahan (Opsional)</p>
                        </div>
                        <textarea name="catatan_customer" rows="3" class="w-full p-6 text-xs font-medium resize-none outline-none text-slate-600" placeholder="Informasi tambahan untuk penjemputan..."></textarea>
                    </div>

                    <!-- Mobile Confirm Btn -->
                    <div class="lg:hidden pb-10">
                        <button type="button" onclick="showConfirmation()" class="w-full py-5 bg-[#1a237e] text-white rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl">
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </div>

                <!-- RIGHT SIDE: CHECKOUT SUMMARY -->
                <div class="lg:col-span-4 lg:sticky lg:top-24 h-fit">
                    <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl border border-slate-100 animate-up" style="animation-delay: 0.2s">
                        
                        <!-- Header Total -->
                        <div class="bg-[#1a237e] p-8 pb-14 text-center">
                            <p class="text-[9px] font-black text-blue-200/50 uppercase tracking-[0.4em] mb-4">Estimasi Pembayaran</p>
                            <div class="flex items-center justify-center gap-1">
                                <h3 class="text-4xl md:text-5xl font-mont font-black text-white tracking-tighter" id="estimated-price">Rp 0</h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="px-8 -mt-8">
                            <div id="checkout-empty" class="bg-slate-50 rounded-[32px] p-10 border border-dashed border-slate-200 text-center flex flex-col items-center justify-center min-h-[220px]">
                                <i class="bi bi-cart-x text-4xl text-slate-200 mb-3"></i>
                                <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">Silakan Pilih Armada</p>
                            </div>

                            <div id="price-box" class="hidden bg-white rounded-[32px] p-8 shadow-xl border border-slate-100 space-y-6">
                                <!-- Promo Badge -->
                                <div id="promo-badge" class="hidden bg-yellow-50 rounded-2xl p-4 border border-yellow-200 flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <i class="bi bi-stars text-yellow-600"></i>
                                        <span class="text-[10px] font-black text-yellow-700 uppercase">Promo Loyalty</span>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[9px] text-slate-400 line-through leading-none" id="original-price">Rp 0</p>
                                        <p class="text-xs font-black text-yellow-600 leading-none mt-1" id="promo-percent">0% OFF</p>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <div class="flex gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-[#fbc02d] mt-1.5 shrink-0 shadow-sm shadow-[#fbc02d]"></div>
                                        <p class="text-[11px] font-bold text-slate-700 leading-tight uppercase" id="summary-armada">-</p>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-1.5 shrink-0 shadow-sm shadow-blue-500"></div>
                                        <p class="text-[11px] font-bold text-slate-700 leading-tight uppercase" id="summary-rute">-</p>
                                    </div>
                                    <div id="li-tol-included" class="hidden flex gap-4">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500 mt-1.5 shrink-0 shadow-sm shadow-green-500"></div>
                                        <p class="text-[11px] font-black text-green-600 uppercase tracking-tight">Termasuk Layanan Jalan Tol</p>
                                    </div>
                                </div>

                                <button type="button" onclick="showConfirmation()" class="w-full py-5 bg-[#fbc02d] text-[#1a237e] font-mont font-black uppercase tracking-widest text-[11px] rounded-2xl hover:scale-[1.02] shadow-[0_10px_30px_rgba(251,192,45,0.2)] transition-all animate-pulse-slow">
                                    Pesan Sekarang
                                </button>
                                
                                <p class="text-center text-[9px] font-bold text-slate-400 tracking-widest uppercase">
                                    *Konfirmasi via WhatsApp
                                </p>
                            </div>
                        </div>
                        <div class="h-10"></div>
                    </div>
                </div>
            </div>

            <!-- CONFIRMATION MODAL -->
            <div id="confirmationModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
                <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-md" onclick="closeConfirmation()"></div>
                <div class="bg-white w-full max-w-lg rounded-[48px] overflow-hidden relative z-10 animate-up shadow-2xl border border-white/20">
                    <div class="p-10 text-center bg-slate-50 border-b border-slate-100">
                        <div class="w-16 h-16 bg-blue-600 rounded-3xl flex items-center justify-center mx-auto mb-5 text-white shadow-lg shadow-blue-200">
                            <i class="bi bi-wallet2 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-mont font-[900] text-[#1a237e] uppercase tracking-tighter mb-2">Review Pesanan</h2>
                        <p class="text-slate-400 text-[9px] font-black uppercase tracking-[0.3em]">Cek kembali rencana perjalanan Anda</p>
                    </div>
                    
                    <div class="p-10 space-y-6">
                        <div class="grid grid-cols-2 gap-y-6 gap-x-8 text-left pb-6 border-b border-slate-100">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5 text-blue-400">Tipe Trip</p>
                                <p id="modal-tipe" class="text-xs font-black text-[#1a237e] uppercase leading-tight tracking-tight">-</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Armada</p>
                                <p id="modal-armada" class="text-xs font-bold text-slate-700 uppercase leading-tight">-</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Waktu Jemput</p>
                                <p id="modal-waktu" class="text-xs font-bold text-slate-700 leading-tight">-</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Rute Utama</p>
                                <p id="modal-rute" class="text-xs font-bold text-slate-700 uppercase leading-tight">-</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex gap-4 p-4 rounded-2xl bg-blue-50/50 border border-blue-100/50">
                                <i class="bi bi-geo-alt-fill text-blue-600 mt-1"></i>
                                <div>
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi Penjemputan</p>
                                    <p id="modal-jemput" class="text-[11px] font-bold text-slate-800 leading-tight">-</p>
                                </div>
                            </div>
                            <div class="flex gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <i class="bi bi-geo-fill text-slate-400 mt-1"></i>
                                <div>
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Lokasi Tujuan</p>
                                    <p id="modal-tujuan" class="text-[11px] font-bold text-slate-800 leading-tight">-</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 pt-6">
                            <button type="submit" class="w-full py-5 bg-[#1a237e] text-white font-mont font-black uppercase tracking-widest text-[11px] rounded-[24px] hover:bg-blue-900 transition-all shadow-xl shadow-blue-100">
                                Konfirmasi & Pesan WhatsApp
                            </button>
                            <button type="button" onclick="closeConfirmation()" class="w-full py-4 text-slate-400 font-black uppercase tracking-widest text-[9px] hover:text-[#1a237e] transition-all">
                                Kembali ke Pengeditan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const allRutes = @json($rutes);
        const activePromo = @json($promo);

        document.addEventListener('DOMContentLoaded', function() {
            const formInputs = {
                layanan: document.getElementById('layanan_id'),
                tujuan: document.getElementById('tujuan_select'),
                armadaSection: document.getElementById('armada_section'),
                armadaGrid: document.getElementById('armada_grid'),
                ruteId: document.getElementById('rute_id_hidden'),
                tipeTrip: document.getElementById('tipe_perjalanan_hidden'),
                priceBox: document.getElementById('price-box'),
                emptyBox: document.getElementById('checkout-empty'),
                estimatedPrice: document.getElementById('estimated-price'),
                tolSection: document.getElementById('tol-section'),
                includeTol: document.getElementById('include_tol'),
                tolPriceDisplay: document.getElementById('tol-price-display'),
                liTol: document.getElementById('li-tol-included'),
                jemput: document.getElementById('titik_jemput'),
                tujuanAlamat: document.getElementById('titik_tujuan')
            };

            let state = {
                price1Way: 0,
                pricePP: 0,
                tollPrice: 0,
                ruteName: "",
                armadaName: "",
                selectedTipe: 'one_way'
            };

            const summary = {
                armada: document.getElementById('summary-armada'),
                rute: document.getElementById('summary-rute')
            };

            formInputs.layanan.addEventListener('change', function() {
                formInputs.tujuan.innerHTML = '<option value="" disabled selected>Pilih Tujuan</option>';
                formInputs.tujuan.disabled = false;
                resetFormState();
                
                const filtered = allRutes.filter(r => r.layanan_id == this.value);
                const unique = [...new Set(filtered.map(r => r.nama_rute))];
                unique.forEach(t => {
                    const opt = document.createElement('option');
                    opt.value = t; opt.textContent = t;
                    formInputs.tujuan.appendChild(opt);
                });
            });

            formInputs.tujuan.addEventListener('change', function() {
                formInputs.tujuanAlamat.value = this.value;
                refreshGrid();
            });

            function refreshGrid() {
                const baseRutes = allRutes.filter(r => r.layanan_id == formInputs.layanan.value && r.nama_rute == formInputs.tujuan.value);
                formInputs.armadaGrid.innerHTML = '';
                resetPartialState();

                if(!baseRutes.length) {
                    formInputs.armadaGrid.innerHTML = '<div class="col-span-full p-10 text-center bg-slate-50 border border-dashed border-slate-200 rounded-[32px] text-slate-400 font-bold text-xs uppercase">Maaf, armada tidak tersedia untuk rute ini.</div>';
                    formInputs.armadaSection.classList.remove('hidden');
                    return;
                }

                formInputs.armadaSection.classList.remove('hidden');
                baseRutes.forEach((r, i) => {
                    const hasPP = r.harga_paket_pp && parseFloat(r.harga_paket_pp) > 0;
                    const card = document.createElement('div');
                    card.className = "bg-white p-5 rounded-[32px] cursor-pointer border-2 border-slate-100 hover:border-blue-600/30 hover:shadow-xl hover:shadow-blue-900/5 transition-all group animate-up relative overflow-hidden";
                    card.dataset.ruteId = r.id;
                    card.style.animationDelay = (i * 0.05) + 's';
                    
                    card.innerHTML = `
                        <div class="space-y-5">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-slate-100 overflow-hidden shrink-0 shadow-sm">
                                    ${r.armada && r.armada.foto ? `<img src="/storage/${r.armada.foto}" class="w-full h-full object-cover">` : `<div class="w-full h-full flex items-center justify-center text-slate-200"><i class="bi bi-truck text-2xl"></i></div>`}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-[#1a237e] text-xs truncate uppercase tracking-tight">${r.armada ? r.armada.nama : 'Executive Class'}</h4>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <i class="bi bi-people-fill text-[#fbc02d] text-[10px]"></i>
                                        <p class="text-[9px] text-slate-400 font-black uppercase tracking-widest">${r.armada ? r.armada.kapasitas + ' Seat' : 'Premium'}</p>
                                    </div>
                                </div>
                                <div class="w-6 h-6 rounded-full border-2 border-slate-100 flex items-center justify-center shrink-0 check-indicator">
                                    <i class="bi bi-check text-blue-600 hidden group-selected"></i>
                                </div>
                            </div>

                            <div class="price-display">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1 current-price-label">Sekali Jalan</p>
                                <p class="text-xl font-mont font-black text-[#1a237e] current-price-value">${fmt(r.harga_paket)}</p>
                            </div>

                            ${hasPP ? `
                            <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
                                <p class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Opsi Perjalanan</p>
                                <div class="flex bg-slate-100 p-1 rounded-xl gap-1">
                                    <button type="button" class="type-btn active px-3 py-1.5 rounded-lg text-[8px] font-black uppercase transition-all" data-type="one_way">Sekali</button>
                                    <button type="button" class="type-btn px-3 py-1.5 rounded-lg text-[8px] font-black uppercase transition-all" data-type="round_trip">PP</button>
                                </div>
                            </div>
                            ` : `
                            <div class="pt-4 border-t border-slate-50">
                                <p class="text-[8px] font-bold text-slate-300 uppercase italic">Paket ini hanya tersedia Sekali Jalan</p>
                            </div>
                            `}
                        </div>
                    `;

                    // Handle full card selection
                    card.addEventListener('click', (e) => {
                        if (e.target.closest('.type-btn')) return; // Ignore if clicking toggle
                        const activeType = card.querySelector('.type-btn.active')?.dataset.type || 'one_way';
                        selectPackage(r, card, activeType);
                    });

                    // Handle local type toggle
                    const typeBtns = card.querySelectorAll('.type-btn');
                    typeBtns.forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            typeBtns.forEach(b => b.classList.remove('active', 'bg-[#1a237e]', 'text-white'));
                            btn.classList.add('active', 'bg-[#1a237e]', 'text-white');
                            
                            const type = btn.dataset.type;
                            const price = type === 'one_way' ? r.harga_paket : r.harga_paket_pp;
                            card.querySelector('.current-price-label').innerText = type === 'one_way' ? 'Sekali Jalan' : 'Pulang Pergi (PP)';
                            card.querySelector('.current-price-value').innerText = fmt(price);
                            
                            // If this card is already the selected one, update total
                            if (card.classList.contains('selected-package')) {
                                selectPackage(r, card, type);
                            }
                        });
                        // Initialize active style
                        if(btn.classList.contains('active')) btn.classList.add('bg-[#1a237e]', 'text-white');
                    });

                    formInputs.armadaGrid.appendChild(card);
                });
            }

            function selectPackage(r, card, type) {
                formInputs.ruteId.value = r.id;
                formInputs.tipeTrip.value = type;
                state = { 
                    price1Way: parseFloat(r.harga_paket), 
                    pricePP: parseFloat(r.harga_paket_pp || 0), 
                    tollPrice: parseFloat(r.harga_tol || 0), 
                    ruteName: r.nama_rute, 
                    armadaName: (r.armada ? r.armada.nama : 'Executive'),
                    selectedTipe: type 
                };

                // Clear other selections
                formInputs.armadaGrid.querySelectorAll('.selected-package').forEach(c => {
                    c.classList.remove('selected-package', 'border-blue-600', 'bg-blue-50/10');
                    c.classList.add('border-slate-100');
                    c.querySelector('.check-indicator').classList.remove('border-blue-600');
                    c.querySelector('.group-selected').classList.add('hidden');
                });

                // Set active selection
                card.classList.add('selected-package', 'border-blue-600', 'bg-blue-50/10');
                card.classList.remove('border-slate-100');
                card.querySelector('.check-indicator').classList.add('border-blue-600');
                card.querySelector('.group-selected').classList.remove('hidden');

                if(state.tollPrice > 0) { formInputs.tolSection.classList.remove('hidden'); updateTollDisplay(); }
                else { formInputs.tolSection.classList.add('hidden'); formInputs.includeTol.checked = false; }
                
                updateFinalPrice();
            }

            function updateFinalPrice() {
                const isPP = state.selectedTipe === 'round_trip';
                let total = isPP ? state.pricePP : state.price1Way;
                if(formInputs.includeTol.checked && state.tollPrice > 0) { 
                    total += (isPP ? state.tollPrice * 2 : state.tollPrice); 
                    formInputs.liTol.classList.remove('hidden'); 
                } else { 
                    formInputs.liTol.classList.add('hidden'); 
                }
                
                if(formInputs.ruteId.value) {
                    formInputs.priceBox.classList.remove('hidden'); 
                    formInputs.emptyBox.classList.add('hidden');
                    summary.armada.innerText = state.armadaName;
                    summary.rute.innerText = `${state.ruteName} (${isPP ? 'PP' : 'Sekali Jalan'})`;

                    if(activePromo && activePromo.is_active) {
                        const disc = (total * activePromo.potongan_persen) / 100;
                        document.getElementById('promo-badge').classList.remove('hidden');
                        document.getElementById('original-price').innerText = fmt(total);
                        document.getElementById('promo-percent').innerText = `${activePromo.potongan_persen}% OFF`;
                        formInputs.estimatedPrice.innerText = fmt(total - disc);
                    } else {
                        document.getElementById('promo-badge').classList.add('hidden');
                        formInputs.estimatedPrice.innerText = fmt(total);
                    }
                }
            }

            function resetFormState() { formInputs.armadaSection.classList.add('hidden'); resetPartialState(); }
            function resetPartialState() { formInputs.ruteId.value = ""; formInputs.priceBox.classList.add('hidden'); formInputs.emptyBox.classList.remove('hidden'); formInputs.tolSection.classList.add('hidden'); formInputs.includeTol.checked = false; }
            function updateTollDisplay() { const isPP = state.selectedTipe === 'round_trip'; formInputs.tolPriceDisplay.innerText = `+${fmt(isPP ? state.tollPrice * 2 : state.tollPrice)}`; }
            function fmt(n) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n); }
            formInputs.includeTol.addEventListener('change', updateFinalPrice);
        });

        function showConfirmation() {
            if(!document.getElementById('rute_id_hidden').value) { Swal.fire({ icon: 'warning', text: 'Pilih armada & tipe perjalanan dahulu.', background: '#fff', color: '#111' }); return; }
            const summaryData = {
                rute: document.getElementById('summary-rute').innerText,
                armada: document.getElementById('summary-armada').innerText,
                tgl: document.getElementsByName('tanggal_berangkat')[0].value,
                jam: document.getElementsByName('waktu_jemput')[0].value,
                tipe: document.getElementById('tipe_perjalanan_hidden').value === 'round_trip' ? 'PULANG PERGI (PP)' : 'SEKALI JALAN',
                jemput: document.getElementById('titik_jemput').value || '-',
                tujuan: document.getElementById('titik_tujuan').value || '-'
            };
            document.getElementById('modal-rute').innerText = summaryData.rute;
            document.getElementById('modal-armada').innerText = summaryData.armada;
            document.getElementById('modal-waktu').innerText = `${summaryData.tgl} @ ${summaryData.jam}`;
            document.getElementById('modal-tipe').innerText = summaryData.tipe;
            document.getElementById('modal-jemput').innerText = summaryData.jemput;
            document.getElementById('modal-tujuan').innerText = summaryData.tujuan;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        function closeConfirmation() { document.getElementById('confirmationModal').classList.add('hidden'); }
    </script>
</body>
</html>
