<div>

    @include('blog::hero.index', [
        'name' => $product->name,
        'category' => $product->category,
        'title' => 'فروشگاه',
    ])
    <section style="overflow: inherit !important" class="section pb-0">
        @include('shop::product-page.product-detail')
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
</div>
