{{--@php use Illuminate\Support\Facades\Log; @endphp--}}
{{--<li class="has-submenu parent-menu-item">--}}
{{--    @if(isset($display))--}}
{{--        <a--}}
{{--            href="{{ isset($route) ? route($route, $slug) : "#" }}"--}}
{{--        >--}}
{{--            {{ $name }}--}}
{{--        </a>--}}
{{--        @if (is_array($items) && count($items) > 0)--}}
{{--            <span class="submenu-arrow"></span>--}}
{{--            <ul style="display: block" class="submenu">--}}
{{--                @foreach($items as $item)--}}
{{--                    @if($item["name"] == "برد")--}}
{{--                        @php--}}
{{--                            Log::info($item)--}}
{{--                        @endphp--}}
{{--                    @endif--}}
{{--                    <x-layout.header-megamenu-item--}}
{{--                        :name="$item['name']"--}}
{{--                        :display="$item['is_visible']"--}}
{{--                        :items="$item['children']"--}}
{{--                        route="blog.article.list"--}}
{{--                        :slug="$item['slug']"--}}
{{--                    />--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        @endif--}}
{{--    @endif--}}
{{--</li>--}}

@if (is_array($items) && count($items) > 0)
    @php
        $targetRoute = $route ? route($route, $slug) : "#"
    @endphp
    <li class="has-megasubmenu">
        <a style="align-items: center;" class="dropdown-item d-flex justify-content-between align-item-center"
           href="{{ $targetRoute }}"
        >
            {{ $name }}
            <x-icon-o-chevron-left/>
        </a>
        <div class="megasubmenu dropdown-menu">
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-6">
                        <a style="align-items: center;"
                           class="d-flex align-center justify-content-between align-item-center"
                           href="{{ $targetRoute }}"
                        >
                            <h6 class="title">
                                {{ $parent["name"] }}
                            </h6>
                            <x-icon-o-chevron-left/>
                        </a>
                        <ul class="list-unstyled bg-light">
                            @foreach ($parent["children"] as $child)
                                <li>
                                    <a
                                        href="{{ route('shop.product.list', $child["slug"]) }}"
                                    >
                                        {{ $child["name"] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
    </li>
@else
    <li>
        <a
            class="dropdown-item"
            href="{{ route('shop.product.list', $category["slug"]) }}"
        >
            {{ $category["name"] }}
        </a>
    </li>
@endif
