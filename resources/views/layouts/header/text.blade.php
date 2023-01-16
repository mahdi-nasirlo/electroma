@include('layouts.header.topheader')
<style>
    @media only screen and (min-width: 990px) {
        #Mynavigation {
            justify-content: end;
            display: flex !important;
            align-items: center
        }
    }


    @media only screen and (max-width: 990px) {
        #Mynavigation {
            display: none !important;
        }
    }

    #topnav .menu-tow>li>a {
        padding-top: 5px;
        padding-bottom: 5px;
        min-height: 15px
    }

    #topnav .menu-tow .has-submenu .menu-arrow {
        top: 12px !important;
    }

    #topnav .menu-tow>.has-submenu:hover .menu-arrow {
        top: 16px !important;
    }
</style>
@php
    
    $courses = \App\Models\Shop\Course::all()
        ->where('inventory', '>', 0)
        ->where('published_at', '<', now());
    
    // FIXME product condition to display category
    $products = \App\Models\Shop\Product::all();
    // ->where('inventory', '>', 0)
    // ->where('published_at', '<', now());
    
    $categoreis = \App\Models\Blog\Category::all()
        ->where('is_visible', true)
        ->where('parent_id', 0);
    
    $shopCategoies = \App\Models\Shop\ShopCategory::all()
        ->where('is_visible', true)
        ->where('parent_id', null);
    
    $pages = \App\Models\Page::all();
    
@endphp

<header id="topnav" class="defaultscroll sticky bg-white border-bottom">
    <div class="container-xl d-flex justify-content-between">
        <!-- Logo container-->
        <div class="d-flex">
            <a class="logo" href="/">
                <img style="width: 30%;height: auto;"
                    src="http://localhost:8000/theme/4lKigFHb7apnVK4fIAijoXeoFusyhJ-metaZWxjdHJvbWFfcGFnZS0wMDAxLnBuZw==-.png"
                    alt="Logo" height="100">
            </a>
        </div>
        <!--end login button-->
        <!-- End Logo container-->
        <div style="display: flex;align-items: center" class="menu-extras">
            <div class="menu-item">
                {{-- <button type="button" class="btn-open first">Open!</button> --}}

                <!-- Mobile menu toggle-->

                <button class="menu btn-open first navbar-toggle" id="toggleMenu" aria-label="Main Menu">
                    <svg style="filter: opacity(0.7)" width="50" height="50" viewBox="0 0 100 100">
                        <path class="line line1"
                            d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                        <path class="line line2" d="M 20,50 H 80" />
                        <path class="line line3"
                            d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                    </svg>
                </button>

                <!-- End mobile menu toggle-->
            </div>
        </div>

        @include('layouts.header.mobile_menu')

        <div id="Mynavigation" class="w-50">
            <!-- Navigation Menu-->
            <ul class="navigation-menu justify-content-end w-100">

                <li style="margin: 13px 0" class="w-100">
                    <livewire:search />
                </li>

                <li class="has-submenu parent-menu-item d-flex">
                    @auth
                        <div class="dropdown dropdown-primary">
                            <button type="button" class="btn my-3 btn-soft-primary px-3 py-1 shadow-none"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-user align-middle icons"></i>
                            </button>
                            <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-3"
                                style="width: 200px; margin: 0px;">

                                @if (auth()->user()->canAccessFilament())
                                    <a class="dropdown-item border border-danger rounded text-danger"
                                        href="{{ route('filament.pages.dashboard') }}">
                                        <i class="text-danger uil uil-user align-middle me-1">
                                        </i> پنل مدیریت</a>
                                @endif

                                <a class="dropdown-item text-dark" href="{{ route('profile', ['tab' => 'dashboard']) }}"><i
                                        class="uil uil-user align-middle me-1"></i> حساب کاربری</a>
                                <a class="dropdown-item text-dark" href="{{ route('profile', ['tab' => 'order']) }}"><i
                                        class="uil uil-clipboard-notes align-middle me-1"></i> سفارشات من </a>
                                <a class="dropdown-item text-dark" href="{{ route('profile', ['tab' => 'address']) }}">
                                    <i class="uil uil-map-marker h5 align-middle me-2 mb-0"></i> آدرس </a>
                                <div class="dropdown-divider my-3 border-top"></div>
                                <button class="dropdown-item text-dark"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="uil uil-sign-out-alt align-middle me-1"></i> خروج </button>
                                <form id="logout-form" action="{{ route('filament.auth.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <i style="transform: scaleX(-1)" class="uil uil-arrow-right d-flex align-items-center"></i>
                        <a class="px-1" href="{{ route('filament.auth.login') }}">
                            ورود
                        </a>
                    @endauth
                </li>

                <livewire:cart.cart-header />

            </ul>

        </div>
        <!--end navigation-->
    </div>
    <div class="container-xl d-flex justify-content-between pb-2">

        <div id="Mynavigation">
            <!-- Navigation Menu-->
            <ul style="margin-right: -22px" class="navigation-menu menu-tow justify-content-end">

                @include('layouts.header.mega-sub-menu')

                @if (count($categoreis) > 0)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">مجله تخصصی تعمیرات </a>
                        <span class="menu-arrow"></span>
                        <ul class="submenu">
                            @include('layouts.header.article-sub-item', ['categoreis' => $categoreis])
                        </ul>
                    </li>
                @endif
                @if (count($courses) > 0)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">دوره های آموزشی </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @foreach ($courses as $item)
                                <li class="has-submenu parent-menu-item">
                                    <a href="{{ route('cours.single', $item) }}"> {{ $item->title }} </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if (count($products) > 0)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">فروشگاه</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @include('layouts.header.article-sub-item', ['categoreis' => $shopCategoies])
                        </ul>
                    </li>
                @endif

                @if ($pages->count())
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">لینک های مفید
                        </a>
                        <span class="menu-arrow"></span>

                        <ul class="submenu">
                            @foreach ($pages as $page)
                                <li class="has-submenu parent-menu-item">
                                    <a href="{{ route('pages', $page) }}"> {{ $page->name }} </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
        </div>


        @if (!request()->routeIs('home'))
            <a class="px-0" href="{{ route('service') }}">
                <span class="bg-soft-warning px-2 py-1 rounded">
                    درخواست تعمیرکار
                </span>
            </a>
        @endif
        <!--end navigation-->
    </div>
    <!--end container-->
</header>
