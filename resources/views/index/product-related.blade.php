@php
    $products =
        $product instanceof \App\Models\Shop\Product
            ? \App\Models\Shop\Product::where('id', '!=', $product->id)
                ->where('category_id', $product->category_id)
                ->get()
            : $product;
@endphp
@if (!$products->isEmpty())
    <div class="row mb-4 pt-2 mt-3 border rounded-3">
        <div class="col-12">
            <h5 class="mb-0">{{ $label }}</h5>
        </div>

        <div class="col-12 my-4">
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
@endif
