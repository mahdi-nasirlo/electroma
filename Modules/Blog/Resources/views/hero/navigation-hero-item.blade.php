@if (isset($category))
    @foreach ($category->getAncestors()->reverse() as $item)
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ $item->link() }}">
                {{ $item->name }}
            </a>
            <x-icon-o-chevron-left />
        </li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ $category->link() }}">
            {{ $category->name }}
        </a>
    </li>
@endif
