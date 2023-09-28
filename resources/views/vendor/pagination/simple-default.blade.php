@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>Предыдущий</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Предыдущий</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Следующий</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>Следующий</span></li>
            @endif
        </ul>
    </nav>
@endif
