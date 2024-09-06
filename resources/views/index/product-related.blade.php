@php
    use App\Models\Shop\Product;$products =
        $product instanceof Product
            ? Product::where('id', '!=', $product->id)
                ->where('category_id', $product->category_id)
                ->get()
            : $product;
@endphp
@if (!$products->isEmpty())
    <div class="row mb-4 pt-2 mt-3 border rounded-3 bg-soft-warning rounded-md">
        <div class="col-12">
            <h5 class="mb-0">{{ $label }}</h5>
        </div>

        <div class="col-12 my-4">
            <div class="{{ $name }}">
                @foreach ($products as $product)
                    <div class="tiny-slide">
                        @include("shop::components.product-cart")
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

