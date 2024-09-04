@foreach ($categoreis as $category)
    @if (count($category["children"]) > 0)
        <li class="has-megasubmenu">
            <a style="align-items: center;" class="dropdown-item d-flex justify-content-between align-item-center"
                href="{{ route('shop.product.list', $category["slug"]) }}"
            >
                {{ $category["name"] }}
                <x-icon-o-chevron-left />
            </a>
            <div class="megasubmenu dropdown-menu">
                <div class="row">
                    @foreach ($category["children"] as $parent)
                        <div class="col-6">
                            <a style="align-items: center;"
                                class="d-flex align-center justify-content-between align-item-center"
                                href="{{ route('shop.product.list', $parent["slug"]) }}"
                            >
                                <h6 class="title">
                                    {{ $parent["name"] }}
                                </h6>
                                 <x-icon-o-chevron-left />
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
@endforeach
