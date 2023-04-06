<div style="margin-right: 1px;" class="card shop-list border-0 rounded position-relative shadow mb-1">
    <div class="shop-image position-relative overflow-hidden rounded shadow">
        <a href="{{ route('shop.product.single', $product) }}">
            <img src="{{ $product->getCoverUrl() }}" class="img-fluid" style="width: 100%" alt="">
        </a>
        @if (isset($product->cover_hover))
            <a href="{{ route('shop.product.single', $product) }}" class="overlay-work">
                <img src="/storage/{{ $product->cover_hover }}" class="img-fluid" alt="">
            </a>
        @endif
        @if (!isset($product->inventory))
            <div class="overlay-work">
                <div class="py-2 bg-soft-dark rounded-bottom out-stock">
                    <h6 class="mb-0 text-center">تمام شده</h6>
                </div>
            </div>
        @else
            <ul class="list-unstyled shop-icons">
                <li>
                    <a href="{{ route('shop.product.single', $product) }}" data-bs-toggle="modal"
                        data-bs-target="#productview" class="btn btn-icon btn-pills btn-soft-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-eye icons">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </a>
                </li>
                <li class="mt-2">
                    <a href="{{ route('cart.index') }}" class="btn btn-icon btn-pills btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-shopping-cart icons">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        @endif
    </div>
    <div style="display: flex !important;flex-direction: column;align-items: center;justify-content: space-between;"
        class="card-body pt-3 p-2 product-card">
        <a href="{{ route('shop.product.single', $product) }}" {{-- style="height: 66px"  content  --}}
            class="text-warning product-name h6 mb-0 text-center">
            @if (isset($product->name))
                {{ $product->name }}
            @endif
        </a>
        <div class="mt-3 pt-3 w-100 d-flex justify-content-between">
            <h6 class="text-muted small fst-italic mb-0 text-center">
                @if ($product->discountItem)
                    {{ number_format($product->discounted_price) }} <del
                        class="text-danger ms-1">{{ number_format($product->price) }}</del> تومان
                @else
                    {{ number_format($product->price) }} تومان
                @endif
            </h6>

            @if (isset($product->rate))
                <ul style="display: flex; flex-direction: row"
                    class="list-unstyled text-warning mb-0 p-0 justify-content-center">

                    @for ($i = 0; $i < 5; $i++)
                        <li class="list-inline-item">
                            @if ($i > $product->rate - 1)
                                <x-font-star-o style="width: 14px;height: 14px;" />
                            @else
                                <x-font-star style="width: 14px;height: 14px;" />
                            @endif
                        </li>
                        {{-- <li class="list-inline-item"><i
                                class="mdi mdi-star @if ($i > $product->rate - 1) mdi-star-outline @endif"></i>
                        </li> --}}
                    @endfor
                </ul>
            @endif
        </div>
        <div style="cursor: pointer;" wire:click='addToCart'
            class="w-100 rounded-md text-center py-1 text-white {{ $has_inventory ? 'bg-warning' : 'bg-soft-warning' }}">
            افزودن به سبد خرید
            <div style="width: 25px; height: 25px" wire:loading class="spinner-grow btn-group" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span wire:loading.remove>
                <x-icon-s-shopping-cart />
            </span>
        </div>
    </div>
</div>
