@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 md:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 bg-gray-50 border border-gray-100 cursor-default rounded-[20px]">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-[#1a237e] bg-white border border-gray-100 rounded-[20px] hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm active:scale-95">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-[#1a237e] bg-white border border-gray-100 rounded-[20px] hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm active:scale-95">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-6 py-3 text-[10px] font-black uppercase tracking-[0.2em] text-gray-300 bg-gray-50 border border-gray-100 cursor-default rounded-[20px]">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden md:flex-1 md:flex md:items-center md:justify-between">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">
                    Showing 
                    <span class="text-[#1a237e] font-black">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="text-[#1a237e] font-black">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="text-[#1a237e] font-black">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex gap-2">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center justify-center w-10 h-10 text-gray-300 bg-gray-50 border border-gray-100 cursor-default rounded-xl" aria-hidden="true">
                                <i class="bi bi-chevron-left"></i>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center justify-center w-10 h-10 text-[#1a237e] bg-white border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm active:scale-90" aria-label="{{ __('pagination.previous') }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center justify-center w-10 h-10 text-[10px] font-black text-gray-400 bg-transparent rounded-xl cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center justify-center w-10 h-10 text-[10px] font-black text-white bg-gradient-to-br from-[#1a237e] to-blue-700 rounded-xl shadow-lg shadow-blue-900/20 cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center justify-center w-10 h-10 text-[10px] font-black text-gray-500 bg-white border border-gray-100 rounded-xl hover:bg-blue-50 hover:text-[#1a237e] hover:border-blue-200 transition-all shadow-sm active:scale-90" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center justify-center w-10 h-10 text-[#1a237e] bg-white border border-gray-100 rounded-xl hover:bg-blue-50 hover:border-blue-200 transition-all shadow-sm active:scale-90" aria-label="{{ __('pagination.next') }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center justify-center w-10 h-10 text-gray-300 bg-gray-50 border border-gray-100 cursor-default rounded-xl" aria-hidden="true">
                                <i class="bi bi-chevron-right"></i>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
