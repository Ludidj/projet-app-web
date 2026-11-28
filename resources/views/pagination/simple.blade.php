@if ($paginator->hasPages())
    <nav aria-label="{{ __('interface.pagination') }}">
        <div class="pagination-links">
        @if ($paginator->onFirstPage())
            <span class="pagination-disabled" aria-disabled="true">{{ __('interface.previous') }}</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">{{ __('interface.previous') }}</a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-disabled" aria-disabled="true">{{ $element }}</span>
            @elseif (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page === $paginator->currentPage())
                        <span class="pagination-current" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" aria-label="{{ __('interface.go_to_page', ['page' => $page]) }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">{{ __('interface.next') }}</a>
        @else
            <span class="pagination-disabled" aria-disabled="true">{{ __('interface.next') }}</span>
        @endif
        </div>
    </nav>
@endif
