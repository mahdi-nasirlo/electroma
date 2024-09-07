@php use Modules\Shop\Entities\Product; @endphp
@php use Morilog\Jalali\Jalalian; @endphp
@extends('layouts.master')

@section('script')
    <script src="/static/assets/tiny-slider.js"></script>
@endsection

@section('head')
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
            'product' => $lastProducts,
        ])

        @include('index.info-banner', [
            'banners' => $infoBanner,
        ])

        @include('index.product-related', [
            'name' => 'most-buy-product',
            'label' => 'پرفروش ترین محصولات',
            'product' => $popularProducts,
        ])

    </section>
    @if (count($posts) > 3)
        <section style="margin-top: 80px 0px" class="bg-light pt-4">
            <div class="container-xxl">
                <div class="row mb-4 py-4 rounded-4">
                    <div class="col-12">
                        <h5 class="mb-0">اخرین مقالات</h5>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="last-blog-post">
                            @foreach ($posts as $post)
                                <div class="tiny-slide">
                                    <div class="mb-4 pb-2 last-post-card">
                                        <div class="card blog rounded border-0 shadow last-post-card">
                                            <div class="position-relative">
                                                <img height="200px" style="object-fit: cover;"
                                                     data-src="{{ asset('/storage/' . $post->image) }}"
                                                     class="card-img-top rounded-top" alt="..."/>
                                                <div class="overlay rounded-top bg-dark"></div>
                                            </div>
                                            <div class="card-body content">
                                                <h5>
                                                    <a href="{{ route('blog.article.single', $post) }}"
                                                       style="height: 66px"
                                                       class="card-title title text-dark">
                                                        {{ $post->title }}
                                                    </a>
                                                </h5>
                                                <div class="post-meta d-flex justify-content-between mt-3">
                                                    <ul class="list-unstyled mb-0 ps-0">
                                                        <li class="list-inline-item me-2 mb-0">
                                                            <a href="javascript:void(0)" class="text-muted like">
                                                                <x-font-eye style="height: 18px;width: 18px"/>
                                                                {{ $post->view }}
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)" class="text-muted comments">
                                                                <x-font-comment-o style="height: 18px;width: 18px"/>
                                                                {{ $post->comments->count() }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <a href="{{ route('blog.article.single', $post) }}"
                                                       class="text-muted readmore">ادامه مطلب
                                                        <x-font-angle-left/>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="author">
                                                <small class="text-light user d-block">
                                                    <x-font-user-circle class="mx-1"/>
                                                    </i>{{ $post->user->name }}
                                                </small>
                                                <small class="text-light date">
                                                    <x-icon-o-calendar/>
                                                    {{ Jalalian::forge($post->updated_at)->format('%A, %d %B %Y') }}
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
