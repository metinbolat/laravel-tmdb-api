@if ($paginator->hasPages())
    <!-- paginator -->
    <div class="col-12">
        <ul class="paginator paginator--list">
            @if ($paginator->onFirstPage())
                <li class="paginator__item paginator__item--prev">
                    <a href="#"><i class="icon ion-ios-arrow-back"></i></a>
                </li>
            @else
                <li class="paginator__item paginator__item--prev">
                    <a class="icon ion-ios-arrow-back" href="{{ $paginator->previousPageUrl() }}"></a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="paginator__item">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginator__item paginator__item--active">
                                <a href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="paginator__item">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="paginator__item paginator__item--next">
                    <a class="icon ion-ios-arrow-forward" href="{{ $paginator->nextPageUrl() }}" rel="next"></a>
                </li>
            @else
                <li class="paginator__item paginator__item--next">
                    <a class="icon ion-ios-arrow-forward" href="#"></a>
                </li>
            @endif
        </ul>
@endif
