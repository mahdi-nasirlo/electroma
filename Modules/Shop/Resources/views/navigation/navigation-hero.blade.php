<div class="page-next container ps-0 mt-2">
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb" class="d-inline-block">
            <ul class="breadcrumb mb-0 ps-0">
                <li class="breadcrumb-item">
                    <a href="/">{{ env('APP_NAME') }}</a>
                    <x-icon-o-chevron-left style="color: #a7a7a7 !important" />
                </li>
                <li class="breadcrumb-item">
                    <a href="#">
                        {{ isset($title) ? $title : 'فروشگاه' }}
                    </a>
                    <x-icon-o-chevron-left style="color: #a7a7a7 !important" />
                </li>
                @if (isset($category))
                    @include('shop::navigation.navigation-hero-item', ['category' => $category])
                @else
                    <li class="breadcrumb-item"><a href="#">{{ $string }}</a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
