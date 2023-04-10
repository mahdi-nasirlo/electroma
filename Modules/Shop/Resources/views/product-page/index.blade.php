@extends('layouts.master')

@section('content')
    {{-- @include('blog::hero.index', [
        'name' => $product->name,
        'category' => $product->category,
        'title' => 'فروشگاه',
    ]) --}}
    @include('shop::product-page.product-detail')
    <section style="overflow: inherit !important" class="section pb-0">
        <div>
        </div>
        <section class="container-lg px-2 px-md-4">
            <div>
                @include('shop::product-page.product-related', [
                    'name' => 'related_product',
                    'label' => 'محصولات مرتبط',
                    'product' => $product,
                ])
            </div>
        </section>
        @include('shop::product-page.next-and-previews-product')
    </section>
@endsection

@section('style')
    @vite('resources/css/tiny-slider.css')
@endsection

@section('script')
    <script src="\static\assets\tiny-slider.js"></script>
@endsection
