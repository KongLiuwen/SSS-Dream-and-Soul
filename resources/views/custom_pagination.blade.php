@if ($paginator->hasPages())
    <style>
        .pagination .page-link {
            font-size: 14px; /* 调整字体大小 */
            padding: 8px 12px; /* 调整内边距 */
            border-radius: 4px; /* 圆角 */
        }
        .pagination .page-item  {
            margin: 0 5px;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd; /* 激活页的背景色 */
            border-color: #0d6efd; /* 激活页的边框颜色 */
            color: #fff; /* 激活页的文字颜色 */
        }

        .pagination .page-link:hover {
            background-color: #f8f9fa; /* 悬停时的背景色 */
            color: #0d6efd; /* 悬停时的文字颜色 */
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d; /* 禁用状态的文字颜色 */
        }
    </style>
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
