@php
    $products =
        $product instanceof \Modules\Shop\Entities\Product
            ? \Modules\Shop\Entities\Product::where('id', '!=', $product->id)
                ->where('category_id', $product->category_id)
                ->get()
            : $product;
@endphp

<div class="row mb-4 py-4 rounded-4">
    <div class="col-12">
        <h5 class="mb-0">{{ $label }}</h5>
    </div>

    <div class="col-12 mt-4">
        <div class="{{ $name }}">
            @foreach ($products as $product)
                <div class="tiny-slide">
                    @include('shop::product-list.product-cart', [
                        'product' => $product,
                    ])
                </div>
            @endforeach
        </div>
    </div>
    <!--end col-->
</div>
