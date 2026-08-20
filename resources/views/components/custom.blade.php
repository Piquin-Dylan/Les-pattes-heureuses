@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="mt-10 flex justify-start overflow-x-auto sm:justify-center">

        <div class="flex w-max items-center gap-2 rounded-3xl border border-[#E7DDD4] bg-white p-2 shadow-lg shadow-[#C67C47]/10">

            @if ($paginator->onFirstPage())
                <span class="flex h-11 w-11 cursor-not-allowed items-center justify-center rounded-2xl border border-gray-200 bg-gray-100 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <button
                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    rel="prev"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#E7DDD4] bg-white text-gray-600 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#C67C47] hover:bg-[#F8EFE8] hover:text-[#C67C47]">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>

                </button>
            @endif

            @foreach ($elements as $element)

                @if (is_string($element))
                    <span class="px-2 text-gray-400">
                        {{ $element }}
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#C67C47] font-semibold text-white shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <button
                                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#E7DDD4] bg-white text-gray-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#C67C47] hover:bg-[#F8EFE8] hover:text-[#C67C47]">

                                {{ $page }}

                            </button>
                        @endif

                    @endforeach
                @endif

            @endforeach

            @if ($paginator->hasMorePages())
                <button
                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                    wire:loading.attr="disabled"
                    rel="next"
                    class="flex h-11 w-11 items-center justify-center rounded-2xl border border-[#E7DDD4] bg-white text-gray-600 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#C67C47] hover:bg-[#F8EFE8] hover:text-[#C67C47]">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>

                </button>
            @else
                <span class="flex h-11 w-11 cursor-not-allowed items-center justify-center rounded-2xl border border-gray-200 bg-gray-100 text-gray-400">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif

        </div>

    </nav>
@endif
