<div class="zeynep right">
    <div class="d-flex">
        <a class="logo" href="/">
            <img src="/static/logo.png" alt="Logo" height="100">
        </a>
    </div>

    <ul>
        <li>
            <a>
                <livewire:search />
            </a>
        </li>
        @guest
            <li>
                <a class="px-1 d-flex justify-content-between bg-soft-warning" href="{{ route('filament.auth.login') }}">
                    ورود / ثبت نام
                    <x-icon-o-login />
                </a>
            </li>
        @endguest
        {{-- <livewire:cart::زشقفcart-header /> --}}

        @if (!request()->routeIs('service.index') and Route::has('service.index'))
            <li>
                <a class="text-warning " href="{{ route('service.index') }}">
                    <x-icon-o-cog />
                    درخواست تعمیر کار
                </a>
            </li>
        @endif
        @auth
            @if (auth()->user()->canAccessFilament())
                <li>
                    <a href="{{ route('filament.pages.dashboard') }}">
                        <x-icon-o-view-grid-add />
                        پنل مدیریت
                    </a>
                </li>
            @endif
            <li class="has-submenu">
                <a href="#" data-submenu="stores">
                    <x-icon-o-user />
                    پنل کاربری
                </a>

                <div id="stores" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="stores">منو اصلی</a>
                    </div>

                    <label>پنل کاربری</label>

                    <ul>
                        <li>
                            <a href="{{ route('profile', ['tab' => 'dashboard']) }}">
                                <x-icon-o-user /> حساب کاربری
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('profile', ['tab' => 'order']) }}">
                                <x-icon-o-truck /> سفارشات من
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('profile', ['tab' => 'address']) }}">
                                <x-icon-o-map /> آدرس
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endauth
        @if ($shopCategoies->count() > 0)
            @include('layouts.header.mobile_menu_item', [
                'categoreis' => $shopCategoies,
                'parentName' => 'منو اصلی',
                'title' => 'فروشگاه',
                'id' => 'products',
            ])
        @endif
        @if ($courses->get()->count() > 0)
            <li class="has-submenu">
                <a href="#" data-submenu="course">
                    دوره های آموزشی
                </a>

                <div id="course" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="course">منو اصلی</a>
                    </div>

                    <label>دوره آموزشی</label>

                    <ul>
                        @foreach ($courses->get() as $course)
                            <li>
                                <a href="{{ route('course.single', $course) }}">
                                    {{ $course->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
        @if ($category->count() > 0)
            @include('layouts.header.mobile_menu_item', [
                'categoreis' => $category,
                'parentName' => 'منو اصلی',
                'title' => 'مجله تخصصی تعمیرات',
                'id' => 'articles',
            ])
        @endif

        @if ($pages->count())
            <li class="has-submenu">
                <a href="#" data-submenu="pages">لینک های مفید</a>

                <div id="pages" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="pages">منو اصلی</a>
                    </div>

                    <label>لینک های مفید</label>

                    <ul>
                        @foreach ($pages as $page)
                            <li>
                                <a href="{{ route('pages', $page) }}">
                                    {{ $page->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
        @auth
            <li class="d-flex justify-content-between bg-soft-blue py-2" style="position: absolute;bottom: 0;width: 100%">
                <span class="ps-1">
                    {{ auth()->user()->name }} خوش آمدید
                </span>
                <button style="width: 24%;text-align: left" class="dropdown-item text-dark p-0 w-10 text-left me-1"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="uil uil-sign-out-alt align-middle me-1"></i> خروج </button>
                <form id="logout-form" action="{{ route('filament.auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</div>

<div class="zeynep-overlay"></div>
