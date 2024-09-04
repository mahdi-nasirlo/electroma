<li class="nav-item dropdown has-submenu parent-parent-menu-item">
    <a class="nav-link dropdown-toggle show" aria-expanded="true" href="#" data-bs-toggle="dropdown"
        href="javascript:void(0)">
        فروشگاه </a>
    <span class="menu-arrow"></span>
    <ul class="dropdown-menu submenu show"
        style="margin: 0px; position: absolute;  inset: 0px auto auto 0px;right: -21px; transform: translate(-28.8px, 36px);right: -20px;"
        data-popper-placement="bottom-end">

        @php
            \Illuminate\Support\Facades\Log::info($shopCategoies);
        @endphp
        @if (count($shopCategoies) > 0)
            @include('layouts.header.mega-sub-menu-item', [
                'categoreis' => $shopCategoies,
            ])
        @endif
    </ul>
</li>
