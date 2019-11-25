@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-grey">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo focus:text-indigo cursor-pointer" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true"><span class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-grey">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo focus:text-indigo bg-white cursor-pointer" >{{ $page }}</span></li>
                        @else
                            <li ><a class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo focus:text-indigo cursor-pointer" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo focus:text-indigo" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-grey cursor-pointer" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
