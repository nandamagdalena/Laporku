@if ($paginator->hasPages())
<div class="flex items-center justify-between mt-6 text-sm text-gray-600">

    {{-- Info --}}
    {{-- <div>
        Menampilkan
        <span class="font-medium">{{ $paginator->firstItem() }}</span>
        -
        <span class="font-medium">{{ $paginator->lastItem() }}</span>
        dari
        <span class="font-medium">{{ $paginator->total() }}</span>
        data
    </div> --}}

    {{-- Pagination --}}
     <div class="flex items-center gap-2">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-300">
                ‹
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-100">
                ‹
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)

            @if (is_string($element))
                <span class="px-2 text-gray-400">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-full bg-yellow-400 text-white font-medium">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-100">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 hover:bg-gray-100">
                ›
            </a>
        @else
            <span class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-300">
                ›
            </span>
        @endif

    </div>
</div>
@endif
