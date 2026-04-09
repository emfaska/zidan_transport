@extends('layouts.admin')

@section('title', 'Buat Booking Baru')
@section('header_title', 'Booking Manual (Admin)')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.booking.index') }}" class="text-[#1a237e] font-bold text-sm flex items-center gap-2 hover:text-blue-700 transition">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Daftar Booking
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.booking.store') }}" method="POST">
            @csrf
            
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h3 class="font-black text-[#1a237e] text-lg mb-1 italic">Formulir Pemesanan</h3>
                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest">Buat pesanan baru atas nama pelanggan</p>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                
                <!-- Pilih Pelanggan -->
                <div class="col-span-2">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Pelanggan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <i class="bi bi-person-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select name="user_id" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer">
                            <option value="">-- Cari Pelanggan --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->no_hp }})</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                    @error('user_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <hr class="col-span-2 border-gray-100 my-2">

                <!-- Pilih Layanan & Rute (Professional UI Logic) -->
                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Layanan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <i class="bi bi-grid-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select id="layanan_id" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer">
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                    @error('layanan_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Tujuan / Rute <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <i class="bi bi-geo-alt-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select id="tujuan_select" disabled class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer disabled:bg-gray-100 disabled:text-gray-400">
                            <option value="">Pilih Layanan Dulu...</option>
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Armada Selection Grid -->
                <div id="armada_section" class="col-span-2 hidden animate-fade-in-up">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Pilih Armada & Harga <span class="text-red-500">*</span></label>
                    <div id="armada_grid" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Cards injected via JS -->
                    </div>
                    <input type="hidden" name="rute_id" id="rute_id" required>
                    @error('rute_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <!-- Detail Keberangkatan -->
                <div class="col-span-2 mt-4">
                    <h4 class="font-bold text-[#1a237e] text-sm mb-4 border-b pb-2">Detail Keberangkatan</h4>
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Tanggal Berangkat <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_berangkat" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('tanggal_berangkat') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Jam Jemput <span class="text-red-500">*</span></label>
                    <input type="time" name="waktu_jemput" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('waktu_jemput') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Jumlah Penumpang <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_penumpang" min="1" value="1" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold">
                    @error('jumlah_penumpang') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Opsional</label>
                    <label class="flex items-center gap-2 p-3 border border-gray-200 rounded-xl bg-gray-50 cursor-pointer hover:bg-white transition">
                        <input type="checkbox" name="include_tol" value="1" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-xs font-bold text-gray-700">Termasuk Biaya Tol?</span>
                    </label>
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Jemput Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat_jemput" rows="2" required placeholder="Nama jalan, nomor rumah, patokan..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-semibold resize-none"></textarea>
                    @error('alamat_jemput') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-2">
                    <label for="total_harga" class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Total Harga Final (Fiks)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">Rp</span>
                        <input type="number" name="total_harga" id="total_harga" class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-black" placeholder="Biarkan kosong untuk menggunakan harga standar rute">
                    </div>
                    @error('total_harga') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                    <p class="text-[9px] text-blue-400 mt-2 italic font-bold">Kosongkan jika ingin menggunakan harga otomatis dari rute yang dipilih.</p>
                </div>

                <!-- Driver Assignment (Optional for Admin) -->
                <div class="col-span-2 mt-4">
                    <h4 class="font-bold text-[#1a237e] text-sm mb-4 border-b pb-2">Penugasan Driver (Opsional)</h4>
                </div>

                <div class="col-span-2">
                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest mb-2">Pilih Driver</label>
                    <div class="relative">
                        <i class="bi bi-steering-wheel absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <select name="driver_id" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#fbc02d] focus:border-[#fbc02d] outline-none transition text-sm font-bold appearance-none cursor-pointer">
                            <option value="">-- Tugaskan Nanti --</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }} ({{ ucfirst($driver->status_driver ?? 'off') }})</option>
                            @endforeach
                        </select>
                        <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                    @error('driver_id') <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p> @enderror
                </div>

            </div>

            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#1a237e] text-white rounded-xl font-black text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-900/20 uppercase tracking-widest flex items-center gap-2">
                    <i class="bi bi-check-lg"></i>
                    Buat Booking
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const allRutes = @json($rutes);
    
    document.addEventListener('DOMContentLoaded', function() {
        const layananSelect = document.getElementById('layanan_id');
        const tujuanSelect = document.getElementById('tujuan_select');
        const armadaSection = document.getElementById('armada_section');
        const armadaGrid = document.getElementById('armada_grid');
        const ruteIdInput = document.getElementById('rute_id');

        // 1. Handle Layanan Change
        layananSelect.addEventListener('change', function() {
            const layananId = this.value;
            
            // Reset
            tujuanSelect.innerHTML = '<option value="" disabled selected>Pilih Tujuan...</option>';
            tujuanSelect.disabled = false;
            armadaSection.classList.add('hidden');
            ruteIdInput.value = "";

            // Filter Rutes based on Layanan
            const filteredRutes = allRutes.filter(r => r.layanan_id == layananId);
            
            // Extract Unique Tujuans (nama_rute)
            const uniqueTujuans = [...new Set(filteredRutes.map(r => r.nama_rute))];

            if(uniqueTujuans.length === 0) {
                tujuanSelect.innerHTML = '<option value="" disabled selected>Tidak ada rute tersedia</option>';
                tujuanSelect.disabled = true;
            } else {
                uniqueTujuans.forEach(tujuan => {
                    const option = document.createElement('option');
                    option.value = tujuan;
                    option.textContent = tujuan;
                    tujuanSelect.appendChild(option);
                });
            }
        });

        // 2. Handle Tujuan Change
        tujuanSelect.addEventListener('change', function() {
            const selectedTujuan = this.value;
            const layananId = layananSelect.value;
            
            // Filter available Armadas for this specific Layanan + Tujuan
            const availableRutes = allRutes.filter(r => r.layanan_id == layananId && r.nama_rute == selectedTujuan);

            // Show Armada Section
            armadaSection.classList.remove('hidden');
            armadaGrid.innerHTML = ''; // Clear previous
            ruteIdInput.value = ""; // Reset selection

            // Render Cards
            availableRutes.forEach(rute => {
                const armadaName = rute.armada ? rute.armada.nama : 'Standard Fleet';
                const armadaFoto = rute.armada && rute.armada.foto ? '/storage/' + rute.armada.foto : null;
                const kapasitas = rute.armada ? rute.armada.kapasitas + ' Seat' : 'Standar';
                const formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(rute.harga_paket);

                const card = document.createElement('div');
                card.className = "bg-white border-2 border-gray-100 rounded-2xl p-4 cursor-pointer hover:border-[#1a237e] hover:bg-blue-50 transition group relative overflow-hidden flex items-center gap-4";
                card.onclick = () => selectArmada(rute.id, card);

                card.innerHTML = `
                    <div class="w-16 h-16 rounded-xl bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-200">
                        ${armadaFoto ? `<img src="${armadaFoto}" class="w-full h-full object-cover">` : `<div class="w-full h-full flex items-center justify-center text-gray-400"><i class="bi bi-car-front-fill text-2xl"></i></div>`}
                    </div>
                    <div class="flex-1">
                        <h4 class="font-black text-[#1a237e] text-sm group-hover:text-blue-800 transition">${armadaName}</h4>
                        <p class="text-[10px] text-gray-500 font-bold mb-0.5">${kapasitas}</p>
                        <p class="text-xs font-black text-[#fbc02d]">${formattedPrice}</p>
                    </div>
                    <div class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center selection-ring group-hover:border-[#1a237e]">
                        <div class="w-3 h-3 rounded-full bg-[#1a237e] hidden"></div>
                    </div>
                `;
                armadaGrid.appendChild(card);
            });
        });

        function selectArmada(id, cardElement) {
            // Update Hidden Input
            ruteIdInput.value = id;

            // Visual Selection Logic
            const allCards = armadaGrid.querySelectorAll('div[onclick]');
            allCards.forEach(c => {
                c.classList.remove('border-[#1a237e]', 'bg-blue-50', 'ring-2', 'ring-blue-200');
                c.classList.add('border-gray-100', 'bg-white');
                c.querySelector('.selection-ring').classList.remove('border-[#1a237e]');
                c.querySelector('.selection-ring div').classList.add('hidden');
            });

            // Highlight Selected
            cardElement.classList.remove('border-gray-100', 'bg-white');
            cardElement.classList.add('border-[#1a237e]', 'bg-blue-50', 'ring-2', 'ring-blue-200');
            cardElement.querySelector('.selection-ring').classList.add('border-[#1a237e]');
            cardElement.querySelector('.selection-ring div').classList.remove('hidden');
        }
    });
</script>
@endsection
