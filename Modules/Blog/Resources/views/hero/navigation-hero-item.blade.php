@if (isset($category))
    @foreach ($category->getAncestors()->reverse() as $item)
        <li class="breadcrumb-item active" aria-current="page">
            <a href="@if ($item->posts->count() > 0) {{ route('blog.article.list', $item) }} @endif">
                {{ $item->name }}
            </a>
        </li>
    @endforeach
    <li class="breadcrumb-item active" aria-current="page">
        <a href="@if ($category->posts->count() > 0) {{ route('blog.article.list', $category) }} @endif">
            {{ $category->name }}
        </a>
    </li>

@endif
