@extends('layouts.admin')

@section('title', 'Pengaturan Pusat')
@section('header_title', 'Pengaturan Pusat')

@section('content')
<div class="max-w-4xl">
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-700 rounded-2xl flex items-center gap-3">
            <i class="bi bi-check-circle-fill text-xl"></i>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="space-y-8">
            @foreach($settings as $group => $items)
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 bg-gray-50/30">
                        <h3 class="font-black text-[#1a237e] text-lg uppercase tracking-widest">{{ $group }} Settings</h3>
                    </div>
                    
                    <div class="p-8 space-y-6">
                        @foreach($items as $setting)
                            <div>
                                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">
                                    {{ $setting->display_name }}
                                </label>

                                @if($setting->type === 'text')
                                    <input type="text" name="{{ $setting->key }}" value="{{ $setting->value }}" 
                                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-[#1a237e] focus:outline-none focus:border-[#1a237e] transition-all">
                                @elseif($setting->type === 'number')
                                    <input type="number" name="{{ $setting->key }}" value="{{ $setting->value }}" 
                                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-[#1a237e] focus:outline-none focus:border-[#1a237e] transition-all">
                                @elseif($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" rows="3" 
                                        class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-bold text-[#1a237e] focus:outline-none focus:border-[#1a237e] transition-all">{{ $setting->value }}</textarea>
                                @elseif($setting->type === 'image')
                                    <div class="flex items-center gap-6">
                                        @if($setting->value)
                                            <div class="w-16 h-16 rounded-2xl bg-gray-100 border border-gray-200 overflow-hidden flex-shrink-0">
                                                <img src="{{ asset('storage/' . $setting->value) }}" class="w-full h-full object-contain">
                                            </div>
                                        @endif
                                        <input type="file" name="{{ $setting->key }}" accept="image/*"
                                            class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-blue-50 file:text-[#1a237e] hover:file:bg-blue-100">
                                    </div>
                                @endif
                                <p class="text-[9px] text-gray-400 mt-1 italic italic">Key: <code>{{ $setting->key }}</code></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex justify-end pt-4">
                <button type="submit" 
                    class="px-10 py-4 bg-gradient-to-r from-[#1a237e] to-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-500/20 hover:scale-[1.02] transition-all uppercase tracking-widest text-[11px]">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
