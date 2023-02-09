@extends('layouts.master')

@section('script')
    <script src="/static/assets/tiny-slider.js"></script>
@endsection

@section('head')
    <script src="/static/assets/tiny-slider.css"></script>

    <style>
        .disabled-pagination .tns-nav {
            display: none;
        }

        .disabled-pagination #tns2-mw {
            border-radius: 7px;
        }
    </style>
@endsection

@section('content')
    @php
        $banners = \Modules\Information\Entities\Banner::all();
        $carouselBanner = $banners->where('collection', 'carousel');
        $smallBanner = $banners->where('collection', 'small-banner');
        $mediumBanner = $banners->where('collection', 'medium-banner');
        $categoriesBanner = $banners->where('collection', 'categories-banner');
        $infoBanner = $banners->where('collection', 'info-banner');
        $posts = \Modules\Blog\Entities\Post::latest()->take(4);
    @endphp
    <section class="container-lg px-md-4">
        <div style="margin-top: 20px">
            <div>
                <div class="title-heading">
                    <div class="row gx-2">
                        <div class="col-9">
                            @include('index.carousel', ['banners' => $carouselBanner])
                        </div>
                        <div class="col-3">
                            @include('index.small-banner', [
                                'banner' => $smallBanner->first(),
                            ])
                        </div>
                        @include('index.banner', [
                            'banners' => $mediumBanner,
                        ])
                        <div class="col-12">
                            @include('index.categories', [
                                'banners' => $categoriesBanner,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('index.product-related', [
            'name' => 'last-product-slider',
            'label' => 'اخرین محصولات',
            'product' => \Modules\Shop\Entities\Product::orderBy('created_at', 'desc')->take(8)->get(),
        ])

        @include('index.info-banner', [
            'banners' => $infoBanner,
        ])

        @include('index.product-related', [
            'name' => 'most-buy-product',
            'label' => 'پرفروش ترین محصولات',
            'product' => \Modules\Shop\Entities\Product::withCount('orders')->orderBy('orders_count', 'DESC')->take(8)->get(),
        ])

    </section>
    @if ($posts->count() > 4)
        <section style="margin-top: 80px 0" class="bg-light pt-4">
            <div class="container-xxl">
                <strong class="my-4">آخرین مقالات</strong>

                <div class="py-4">
                    <div class="blog-slider">
                        @foreach ($posts as $post)
                            <div class="tiny-slide rounded-md">
                                @include('home.index-cart', ['post' => $post])
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row pt-2">

                    @foreach ($posts as $post)
                        @include('home.index-cart', ['post' => $post])
                    @endforeach
                    <!--end col-->
                </div>
            </div>
        </section>
    @endif
@endsection
