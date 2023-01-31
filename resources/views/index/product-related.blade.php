@php
    $products =
        $product instanceof \App\Models\Shop\Product
            ? \App\Models\Shop\Product::where('id', '!=', $product->id)
                ->where('category_id', $product->category_id)
                ->get()
            : $product;
@endphp
@if ($products->isNotEmpty())
    <div class="row mb-4 pt-4 shadow border rounded-4">
        <div class="col-12">
            <h5 class="mb-0">{{ $label }}</h5>
        </div>

        <div class="col-12 mt-4">
            <div class="{{ $name }}">
                @foreach ($products as $product)
                    <div class="tiny-slide">
                        @include('livewire.shop.product-cart', [
                            'product' => $product,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
        <!--end col-->
    </div>
@endif
