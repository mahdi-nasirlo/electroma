<div class="row py-2">
    <div class="col-12 d-flex">
        <h5 class="text-muted">
            @if ($product->price != $new_price)
                <del class="text-danger">
                    {{ number_format($product->price) }}
                </del>

                {{ number_format($new_price) }}
                تومان
            @else
                {{ number_format($product->price) }} تومان
            @endif
            {{-- @if ($product->discountItem)
                {{ number_format($product->discounted_price) }} <del
                    class="text-danger ms-1">{{ number_format($product->price) }}</del> تومان
            @else
                {{ number_format($product->price) }} تومان
            @endif --}}
        </h5>
        @if ($count > 1)
            <span style="align-items: center;"
                class="mb-1 text-black-50 d-flex align-item-center mx-2">{{ $count . ' عدد = ' . number_format($new_price * $count) }}</span>
        @endif
    </div>
    @if ($product->tiered_price)
        <div class="col-12 mt-3">
            <h6 class="mb-0">قیمت در تعداد: </h6>
            <div class="table-responsive bg-white shadow rounded my-2">
                <table class="table mb-0 table-center">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="border-bottom" style="min-width: 300px;">قیمت</th>
                            <th scope="col" class="border-bottom text-center" style="width: 100px;">
                                تعداد
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->tiered_price as $price)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <i class="uil uil-comment text-muted h5"></i>
                                        <div class="flex-1 content ms-3">
                                            <a href="forums-comments.html"
                                                class="forum-title text-primary fw-bold">{{ number_format($price['price']) . ' تومان ' }}</a>
                                            <p class="text-muted small mb-0 mt-2">
                                                {{ 100 - round(($price['price'] * 100) / $product->price) }}
                                                درصد تخفیف
                                                <a href="javascript:void(0)" class="text-dark fw-bold">

                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center small">+{{ $price['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <div class="col-12 mt-4 mt-lg-0">
        <h6 class="mb-0">تعداد: </h6>
        <div class="d-flex shop-list align-items-center justify-content-between pt-1">
            <div class="qty-icons d-flex">
                <button wire:click='decrement' onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                    class="btn btn-icon btn-soft-primary minus">-</button>
                <input type="number" wire:model.lazy='count' wire:blur="changeQuantity" min="1"
                    max="{{ $product->inventory }}" name="quantity" value="1" type="number"
                    class="btn btn-icon btn-soft-primary qty-btn quantity">
                <button wire:click='increment' onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                    class="btn btn-icon btn-soft-primary plus">+</button>
            </div>
            <a wire:click='addToCart' class="btn btn-soft-primary pe-3 ms-2">
                {{ $this->cartItem() ? 'بروزرسانی سبد خرید' : 'افزودن به سبد' }}
                <div style="width: 25px; height: 25px" wire:loading class="spinner-grow btn-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </a>
        </div>
        @if (session()->has('cart_message'))
            <div class="badge bg-soft-{{ session('cart_message')['status'] }} me-2 mt-3 my-2 p-2 text-lg-start w-100">
                {{ session('cart_message')['text'] }}
            </div>
        @endif
    </div>
    <!--end col-->
</div>
