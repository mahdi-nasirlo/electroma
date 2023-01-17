@php
    // $shopCategoies = \Modules\Shop\Entities\Category::all()
    //     ->where('is_visible', true)
    //     ->where('parent_id', null);
    
    $category = \Modules\Blog\Entities\Category::get();
    
@endphp
<div class="container-xl d-none justify-content-between pb-1 topnav d-md-flex">
    {{-- @if ($category->count() > 0)
        <li class="has-submenu parent-parent-menu-item">
            <a href="javascript:void(0)">مجله تخصصی تعمیرات </a>
            <span class="menu-arrow"></span>
            <ul class="submenu">
                @include('layouts.header.article-sub-item', ['categoreis' => $category->toTree()])
            </ul>
        </li>
    @endif --}}
    {{-- <div id="Mynavigation"> --}}
    <!-- Navigation Menu-->
    <ul style="margin-right: -22px" class="navigation-menu menu-tow justify-content-end">

        {{-- @include('layouts.header.mega-sub-menu') --}}

        @if ($category->count() > 0)
            <li class="has-submenu parent-parent-menu-item">
                <a href="javascript:void(0)">مجله تخصصی تعمیرات </a>
                <span class="menu-arrow"></span>
                <ul class="submenu">
                    @include('layouts.header.article-sub-item', ['categoreis' => $category->toTree()])
                </ul>
            </li>
        @endif
        {{-- @if (count($courses) > 0)
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
                    @endif --}}
        {{-- @if (count($products) > 0)
                        <li class="has-submenu parent-parent-menu-item">
                            <a href="javascript:void(0)">فروشگاه</a><span class="menu-arrow"></span>
                            <ul class="submenu">
                                @include('layouts.header.article-sub-item', [
                                    'categoreis' => $shopCategoies,
                                ])
                            </ul>
                        </li>
                    @endif --}}

        {{-- @if ($pages->count())
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
                    @endif --}}
    </ul>
</div>


{{-- @if (!request()->routeIs('home'))
                <a class="px-0" href="{{ route('service') }}">
                    <span class="bg-soft-warning px-2 py-1 rounded">
                        درخواست تعمیرکار
                    </span>
                </a>
            @endif --}}
<!--end navigation-->
</div>
