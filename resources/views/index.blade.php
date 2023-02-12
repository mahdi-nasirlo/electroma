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
    @if ($posts->count() > 3)
        <section style="margin-top: 80px 0" class="bg-light pt-4">
            <div class="container-xxl">
                {{-- <strong class="my-4">آخرین مقالات</strong>
                <div class="row pt-2">
                    @foreach ($posts->get() as $post)
                        @include('blog::post-cart', ['post' => $post])
                    @endforeach
                    <!--end col-->
                </div> --}}
                <div class="row mb-4 py-4 rounded-4">
                    <div class="col-12">
                        <h5 class="mb-0">اخرین مقالات</h5>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="last-blog-post">
                            @foreach ($posts->get() as $post)
                                <div class="tiny-slide">
                                    <div class="mb-4 pb-2">
                                        <div class="card blog rounded border-0 shadow">
                                            <div class="position-relative">
                                                <img height="200px" style="object-fit: fill;"
                                                    src="{{ asset('/storage/' . $post->image) }}"
                                                    class="card-img-top rounded-top" alt="..." />
                                                <div class="overlay rounded-top bg-dark"></div>
                                            </div>
                                            <div class="card-body content">
                                                <h5>
                                                    <a href="{{ route('blog.article.single', $post) }}"
                                                        class="card-title title text-dark">
                                                        {{ $post->title }}
                                                    </a>
                                                </h5>
                                                <div class="post-meta d-flex justify-content-between mt-3">
                                                    <ul class="list-unstyled mb-0 ps-0">
                                                        <li class="list-inline-item me-2 mb-0">
                                                            <a href="javascript:void(0)" class="text-muted like">
                                                                <x-font-eye style="height: 18px;width: 18px" />
                                                                {{ $post->view }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)" class="text-muted comments">
                                                                <x-font-comment-o style="height: 18px;width: 18px" />
                                                                {{ $post->comments->count() }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <a href="{{ route('blog.article.single', $post) }}"
                                                        class="text-muted readmore">ادامه مطلب
                                                        <x-font-angle-left />
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="author">
                                                <small class="text-light user d-block">
                                                    <x-font-user-circle class="mx-1" /></i>{{ $post->user->name }}
                                                </small>
                                                <small class="text-light date">
                                                    <x-icon-o-calendar />
                                                    {{ \Morilog\Jalali\Jalalian::forge($post->updated_at)->format('%A, %d %B %Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div>
        </section>
    @endif
@endsection
