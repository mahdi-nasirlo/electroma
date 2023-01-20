<div class="row mt-4 pt-2">
    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
        <div class="d-flex shop-list align-items-center justify-content-center justify-content-md-center mt-3">
            <h6 class="mb-0">تعداد: </h6>
            <div class="qty-icons ms-3">
                <button wire:click='decrement' onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                    class="btn btn-icon btn-soft-primary minus">-</button>
                <input wire:model='count' min="1" max="{{ $product->inventory }}" name="quantity" value="1"
                    type="number" class="btn btn-icon btn-soft-primary qty-btn quantity">
                <button wire:click='increment' onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                    class="btn btn-icon btn-soft-primary plus">+</button>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12">
        <div class="d-flex align-items-center justify-content-center justify-content-md-center mt-3">
            <div>
                <a wire:click='payment' href="javascript:void(0)" class="btn btn-primary">
                    اکنون بخرید
                </a>
                <a wire:click='addToCart' class="btn btn-soft-primary pe-3 ms-2">
                    افزودن به سبد
                    <div style="width: 25px; height: 25px" wire:loading class="spinner-grow" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
