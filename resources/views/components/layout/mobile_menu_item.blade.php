@php use Illuminate\Support\Facades\Log; @endphp
@if ($title)
    @if (count($categoreis) > 0)
        <li class="has-submenu">
            <a
                {{--                href="{{ isset($parentLink) ? $parentLink : '#' }}"--}}
                data-submenu="{{ $id }}">{{ $title }}</a>

            <div id="{{ $id }}" class="submenu">
                <div class="submenu-header">
                    <a href="#" data-submenu-close="{{ $id }}">{{ $parentName }} </a>
                </div>

                <label class="mx-1">{{ $title }}</label>

                <ul>

                    @foreach ($categoreis as $category)
                        @if ($category["is_visible"] )
                            <x-layout.mobile_menu_item
                                :id="'products_' . $category['id']"
                                :title="$category['name']"
                                :parent-name="$title"
                                :categoreis="$category['children']"
                            />
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
    @else
        <li>
            <a
                {{--                href="{{ isset($link) ? $link : '#' }}"--}}
            >
                {{ $title }}
            </a>
        </li>
    @endif
@endif

