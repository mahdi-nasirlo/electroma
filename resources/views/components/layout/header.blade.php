<div>

    {{--  ******** top of header *******  --}}
    <div class="bg-primary text-white">
        <div class=" container-xl d-flex justify-content-between">
            <div class="d-flex">
                <div class="d-flex">
                <span style="display:flex; align-items: center;">
                    <x-icon-o-phone class="mx-1" style="margin: 2px 0"/>
                    تلفن پشتیبانی
                </span>
                    <span class="d-none d-sm-flex px-1 mt-1">
                    {!! Helper::information('mobile_support') !!}
                </span>
                </div>
                <div class="px-1 mt-1" style="direction: rtl">
                    {!! Helper::information('phone_support') !!}
                </div>
            </div>

            <div class="">
                <a style="display: flex;align-items: center;" class="text-white d-flex"
                   href="{{ strip_tags(Helper::information('location')) }}">

                    <x-icon-o-location-marker class="mx-1" style="margin: 2px 0"/>
                    نشانی
                    <span class="d-none d-sm-flex px-1">
                    {{ config('app.name') }}
                </span>
                </a>
            </div>
        </div>
    </div>
    {{--  ******** top of header *******  --}}

    <header class="border-bottom bg-white shadow">

        {{--  ******** topnav *******  --}}
        <div id="topnav" class="topnav">
            <div class="container-xl d-flex justify-content-between ">
                <!-- Logo container-->
                <div class="d-flex">
                    <a class="logo" href="/">
                        <img class="my-1" style="width: 30%;height: auto;" src="{{ asset('/static/logo.png') }}"
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
                                      d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058"/>
                                <path class="line line2" d="M 20,50 H 80"/>
                                <path class="line line3"
                                      d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942"/>
                            </svg>
                        </button>

                        <!-- End mobile menu toggle-->
                    </div>
                </div>

                <div id="Mynavigation" class="w-50">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu justify-content-end w-100">

                        <li style="margin: 13px 0" class="w-100">
                            <livewire:search/>
                        </li>

                        <li class="has-submenu parent-menu-item d-flex align-items-center">
                            @auth
                                <div class="dropdown dropdown-primary">
                                    <button type="button" class="btn my-1 btn-soft-primary px-2 py-1 shadow-none"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <x-icon-o-user/>
                                    </button>
                                    <div
                                        class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 pb-3"
                                        style="width: 200px; margin: 0px;">

                                        <a class="dropdown-item">
                                            <strong> {{ auth()->user()->name }}</strong>
                                        </a>
                                        <div class="dropdown-divider border-top"></div>
                                        @if (auth()->user()->canAccessFilament())
                                            <a class="dropdown-item text-danger "
                                               href="{{ route('filament.pages.dashboard') }}">
                                                <x-icon-o-view-grid-add/>
                                                </i> پنل مدیریت
                                            </a>
                                            <div class="dropdown-divider border-top"></div>
                                        @endif

                                        <a class="dropdown-item text-dark"
                                           href="{{ route('profile', ['tab' => 'dashboard']) }}">

                                            <x-icon-o-user/>
                                            حساب
                                            کاربری
                                        </a>
                                        <a class="dropdown-item text-dark"
                                           href="{{ route('profile', ['tab' => 'order']) }}">
                                            <x-icon-o-truck/>
                                            سفارشات من
                                        </a>
                                        <a class="dropdown-item text-dark"
                                           href="{{ route('profile', ['tab' => 'address']) }}">
                                            <x-icon-o-map/>
                                            آدرس
                                        </a>
                                        <div class="dropdown-divider my-3 border-top"></div>
                                        <button class="dropdown-item text-dark"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <x-icon-s-logout/>
                                            خروج
                                        </button>
                                        <form id="logout-form" action="{{ route('filament.auth.logout') }}"
                                              method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a class="p-0" href="{{ route('filament.auth.login') }}">
                                    <button class="btn px-2 py-1 btn-soft-primary cartBtn shadow-none rounded">
                                        <x-icon-o-login/>
                                    </button>
                                </a>
                            @endauth
                        </li>

                        <livewire:payment::cart.cart-header/>

                    </ul>

                </div>
                <!--end navigation-->
            </div>
            <!--end container-->
        </div>
        {{--  ******** topnav *******  --}}

        {{--  ******** navigation *******  --}}
        <div id="navigation" class="container-xl d-none justify-content-between pb-1 topnav d-md-flex">
            <ul style="margin-right: -22px" class="navigation-menu menu-tow justify-content-end">

                <li class="nav-item dropdown has-submenu parent-parent-menu-item">
                    <a class="nav-link dropdown-toggle show" aria-expanded="true" href="#" data-bs-toggle="dropdown"
                       href="javascript:void(0)">
                        فروشگاه </a>
                    <span class="menu-arrow"></span>
                    <ul class="dropdown-menu submenu show"
                        style="margin: 0px; position: absolute;  inset: 0px auto auto 0px;right: -21px; transform: translate(-28.8px, 36px);right: -20px;"
                        data-popper-placement="bottom-end">
                        @foreach($shopCategories as $shopCategory)
                            @if (count($shopCategory["children"]) > 0)
                                <li class="has-megasubmenu">
                                    <a style="align-items: center;"
                                       class="dropdown-item d-flex justify-content-between align-item-center"
                                       href="{{ route('shop.product.list', $shopCategory["slug"]) }}"
                                    >
                                        {{ $shopCategory["name"]}}
                                        <x-icon-o-chevron-left/>
                                    </a>
                                    <div class="megasubmenu dropdown-menu">
                                        <div class="row">
                                            @foreach ($shopCategory["children"] as $parent)
                                                <div class="col-6">
                                                    <a style="align-items: center;"
                                                       class="d-flex align-center justify-content-between align-item-center"
                                                       href="{{ route('shop.product.list', $parent["slug"]) }}"
                                                    >
                                                        <h6 class="title">
                                                            {{ $shopCategory["name"] }}
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
                                        href="{{ route('shop.product.list', $shopCategory["slug"]) }}"
                                    >
                                        {{ $shopCategory["name"] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>


                @if (count($courses) > 0)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">دوره های آموزشی </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            @foreach ($courses->get() as $item)
                                <li class="has-submenu parent-menu-item">
                                    <a href="{{ route('course.single', $item) }}"> {{ $item->title }} </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if (count($category) > 0)
                    <li class="has-submenu parent-parent-menu-item">
                        <a href="javascript:void(0)">مجله تخصصی تعمیرات </a>
                        <span class="menu-arrow"></span>
                        <ul class="submenu">
                            @include('layouts.header.article-sub-item', ['categoreis' => $category])
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
            @if (!request()->routeIs('service.index') and Route::has('service.index'))
                <a class="px-0" href="{{ route('service.index') }}">
            <span class="bg-soft-warning px-2 py-1 rounded">
                درخواست تعمیرکار
            </span>
                </a>
            @endif
        </div>
        {{--  ******** navigation *******  --}}
    </header>

</div>
