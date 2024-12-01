<div class="col-12 mt_25">
    <div class="wsus__pagination">
        <nav aria-label="Page navigation example">
            <ul class="pagination">

                @if ($paginator->onFirstPage())

                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                        <i class="far fa-angle-left"></i>
                    </a>
                    </li>
                @endif

                @foreach ($elements as $element)
                    @if (count($element) < 2)

                    @else
                        @foreach ($element as $key => $el)
                            @if ($key == $paginator->currentPage())
                                <li class="page-item"><a class="page-link active" href="javascript::void()">{{ $key }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $el }}">{{ $key }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                            <i class="far fa-angle-right"></i>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</div>
