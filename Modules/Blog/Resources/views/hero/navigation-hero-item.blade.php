@if (isset($category))
    @foreach ($category->getAncestors()->reverse() as $item)
        <li class="breadcrumb-item active" aria-current="page">
            <a href="{{ $category->link() }}">
                {{ $item->name }}
            </a>
        </li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">
        <a href="{{ $category->link() }}">
            {{ $category->name }}
        </a>
    </li>
@endif
