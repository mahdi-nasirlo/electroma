@if (count($categoreis) > 0)
    @foreach ($categoreis as $item)
        @if ($item["is_visible"])
            <li class="has-submenu parent-menu-item">
                <a
                    href="{{ route('blog.article.list', $item["slug"]) }}"
                >
                    {{ $item["name"] }}
                </a>
                @if (count($item["children"]) > 0)
                    <span class="submenu-arrow"></span>
                    <ul style="display: block" class="submenu">
                        @include('layouts.header.article-sub-item', [
                            'categoreis' => $item["children"],
                            'category' => $item,
                        ])
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
@endif
