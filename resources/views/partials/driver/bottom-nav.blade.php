<nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 flex justify-center z-[100] shadow-[0_-10px_20px_rgba(0,0,0,0.02)]">
    <div class="w-full max-w-md px-4 py-3 flex justify-around items-center">
        <a href="{{ route('driver.dashboard') }}" class="flex flex-col items-center gap-1 group {{ Request::is('driver/dashboard') ? 'text-[#1a237e]' : 'text-gray-400' }}">
            <div class="p-2 rounded-xl {{ Request::is('driver/dashboard') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }} transition-all">
                <i class="bi {{ Request::is('driver/dashboard') ? 'bi-grid-fill' : 'bi-grid' }} text-xl"></i>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest">Beranda</span>
        </a>
        
        <a href="{{ route('driver.history') }}" class="flex flex-col items-center gap-1 group {{ Request::is('driver/history') ? 'text-[#1a237e]' : 'text-gray-400' }}">
            <div class="p-2 rounded-xl {{ Request::is('driver/history') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }} transition-all">
                <i class="bi {{ Request::is('driver/history') ? 'bi-calendar-check-fill' : 'bi-calendar-check' }} text-xl"></i>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest">Riwayat</span>
        </a>

        <a href="{{ route('driver.wallet.index') }}" class="flex flex-col items-center gap-1 group {{ Request::is('driver/wallet*') ? 'text-[#1a237e]' : 'text-gray-400' }}">
            <div class="p-2 rounded-xl {{ Request::is('driver/wallet*') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }} transition-all">
                <i class="bi {{ Request::is('driver/wallet*') ? 'bi-wallet2-fill' : 'bi-wallet2' }} text-xl"></i>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest">Dompet</span>
        </a>

        <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 group {{ Request::is('profile*') ? 'text-[#1a237e]' : 'text-gray-400' }}">
            <div class="p-2 rounded-xl {{ Request::is('profile*') ? 'bg-blue-50' : 'group-hover:bg-gray-50' }} transition-all">
                <i class="bi {{ Request::is('profile*') ? 'bi-person-fill' : 'bi-person' }} text-xl"></i>
            </div>
            <span class="text-[9px] font-black uppercase tracking-widest">Akun</span>
        </a>
    </div>
</nav>
