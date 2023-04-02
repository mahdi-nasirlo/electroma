@if (isset($category))
    @foreach ($category->getAncestors()->reverse() as $item)
        <li class="breadcrumb-item product-category active" aria-current="page">
            <a href="{{ $item->link() }}">
                {{ $item->name }}
            </a>
            <x-icon-o-chevron-left style="color: #a7a7a7 !important" />
        </li>
    @endforeach
    <li class="breadcrumb-item product-category active" aria-current="page">
        <a href="{{ $category->link() }}">
            {{ $category->name }}
        </a>
    </li>
@endif
