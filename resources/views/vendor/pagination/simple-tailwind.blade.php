@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-end mr-0">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 cursor-default leading-5">
                {!! __('Zurück') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-black leading-5 hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300  active:text-gray-700 transition ease-in-out duration-150">
                {!! __('Zurück') !!}
            </a>
        @endif
        <div class="py-2">|</div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-black  leading-5 rounded-md hover:text-gray-500 focus:outline-none  active:text-gray-700 transition ease-in-out duration-150 ">
                {!! __('Nächste') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 cursor-default leading-5">
                {!! __('Nächste') !!}
            </span>
        @endif
    </nav>
@endif
