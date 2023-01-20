<div class="page-next">
    <nav aria-label="breadcrumb" class="d-inline-block">
        <ul class="breadcrumb bg-white rounded shadow mb-0">
            <li class="breadcrumb-item"><a href="/">{{ env('APP_NAME') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ isset($title) ? $title : 'وبلاگ' }}</a></li>
            @if (isset($category))
                @include('blog::hero.navigation-hero-item', ['category' => $category])
            @else
                <li class="breadcrumb-item"><a href="#">{{ $string }}</a></li>
            @endif
        </ul>
    </nav>
</div>
