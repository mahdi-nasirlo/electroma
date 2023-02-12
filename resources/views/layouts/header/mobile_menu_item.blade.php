{{-- @foreach ($categoreis as $category)
    @if ($category->is_visible and $category->isVisible())
        @if ($category->childIsVisible())
            <li class="headersection">
                <input type="checkbox" id="{{ $category->id }}" />
                <label for="{{ $category->id }}">
                    <a href="{{ $category->categoryLink() }}">
                        {{ $category->name }}
                    </a>
                </label>
                <ul>
                    @include('layouts.header.mobile_menu_item', ['categoreis' => $category->children])
                </ul>
            </li>
        @else
            <li>
                <a href="{{ $category->categoryLink() }}">
                    {{ $category->name }}
                </a>
            </li>
        @endif
    @endif
@endforeach --}}


{{-- 
@if ($title)
    @if ($categoreis->isEmpty())
        <li>
            <a href="#">
                {{ $title }}
            </a>
        </li>
    @else
        @foreach ($categoreis as $category)
            <li class="has-submenu">
                <a href="#" data-submenu="{{ $category->id }}">{{ $category->name }}</a>

                <div id="{{ $category->id }}" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="{{ $category->id }}">{{ $parentName }}</a>
                    </div>

                    <label>{{ $category->name }}</label>

                    <ul>
                        @foreach ($categoreis as $category)
                            @if ($category->is_visible and $category->isVisible())
                                @include('layouts.header.mobile_menu_item', [
                                    'categoreis' => $category->children,
                                    'title' => $category->name,
                                    'parentName' => $title,
                                    'id' => 'products_' . $category->id,
                                ])
                            @endif
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach
    @endif
@else
@endif --}}


@if ($title)
    @if ($categoreis->isEmpty())
        <li>
            <a href="{{ isset($link) ? $link : '#' }}">
                {{ $title }}
            </a>
        </li>
    @else
        <li class="has-submenu">
            <a href="{{ isset($parentLink) ? $parentLink : '#' }}"
                data-submenu="{{ $id }}">{{ $title }}</a>

            <div id="{{ $id }}" class="submenu">
                <div class="submenu-header">
                    <a href="#" data-submenu-close="{{ $id }}">{{ $parentName }} </a>
                </div>

                <label class="mx-1">{{ $title }}</label>

                <ul>

                    @foreach ($categoreis as $category)
                        {{-- TODO FIX DISPLY CONDITION --}}
                        {{-- @if ($category->is_visible and $category->isVisible()) --}}
                        @include('layouts.header.mobile_menu_item', [
                            'link' => $category->link(),
                            'parentLink' => $category->link(),
                            'categoreis' => $category->children()->get(),
                            'title' => $category->name,
                            'parentName' => $title,
                            'id' => 'products_' . $category->id,
                        ])
                        {{-- @endif --}}
                    @endforeach
                </ul>
            </div>
        </li>
    @endif
@endif
