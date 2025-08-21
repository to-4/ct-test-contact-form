@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Pagination">
    {{-- 前へ --}}
    @if ($paginator->onFirstPage())
        <span class="pager__item is-disabled">＜</span>
    @else
        <a class="pager__item" href="{{ $paginator->previousPageUrl() }}">＜</a>
    @endif

    {{-- 数字（1〜最終） --}}
    @foreach (range(1, $paginator->lastPage()) as $page)
        @if ($page == $paginator->currentPage())
            <span class="pager__item is-current">{{ $page }}</span>
        @else
            <a class="pager__item" href="{{ $paginator->url($page) }}">{{ $page }}</a>
        @endif
    @endforeach

    {{-- 次へ --}}
    @if ($paginator->hasMorePages())
        <a class="pager__item" href="{{ $paginator->nextPageUrl() }}">＞</a>
    @else
        <span class="pager__item is-disabled">＞</span>
    @endif
</nav>
@endif
