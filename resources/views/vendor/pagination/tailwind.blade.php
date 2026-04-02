@if ($paginator->hasPages())
<div class="pagination">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <div class="page-item" style="opacity:0.4;cursor:default">‹</div>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-item">‹</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <div class="page-item" style="border:none">...</div>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <div class="page-item active">{{ $page }}</div>
                @else
                    <a href="{{ $url }}" class="page-item">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-item">›</a>
    @else
        <div class="page-item" style="opacity:0.4;cursor:default">›</div>
    @endif
</div>
@endif