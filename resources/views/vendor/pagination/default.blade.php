@if ($paginator->hasPages())
    <div class="w3-row">
        <ul class="w3-center w3-text-grey pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="display:none;"><span class="fa fa-chevron-left"></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="fa fa-chevron-left"></span></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span class="w3-xxxlarge">{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="fa fa-chevron-right"></span></a></li>
        @else
            <li class="disabled" style="display:none;"><span class="fa fa-chevron-right"></span></li>
        @endif
        </ul>
    </div>
@endif
