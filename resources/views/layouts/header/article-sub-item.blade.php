@if ($categoreis->count() > 0)
    @foreach ($categoreis as $item)
        {{-- $item->is_visible and $item->isVisible() --}}
        @if ($item->is_visible)
            <li class="has-submenu parent-menu-item">
                <a href="{{ $item->categoryLink() }}">
                    {{ $item->name }}
                </a>
                {{-- $item->childIsVisible() --}}
                @if ($item->children->count() > 0)
                    <span class="submenu-arrow"></span>
                    <ul style="display: block" class="submenu">
                        @include('layouts.header.article-sub-item', [
                            'categoreis' => $item->children,
                            'category' => $item,
                        ])
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
@endif
