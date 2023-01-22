@if ($cart->getModel() instanceof \Modules\Shop\Entities\Product)
    <a href="{{ route('shop.product.single', $cart->getModel()) }}" class="d-flex align-items-center">
        <img src="{{ asset('/storage/' . $cart->getModel()->cover) }}" class="shadow rounded" style="max-height: 64px;"
            alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">
                {{ $cart->getModel()->name }}
            </h6>
            <p class="text-muted mb-0">
                @if ($cart->getModel()->discountItem)
                    {{ number_format((int) $cart->getModel()->price) }} تومان
                    |
                @endif
                {{ $cart->get('quantity') }} عدد
            </p>
        </div>
        <h6 class="text-dark mb-0">{{ number_format((int) $cart->getModel()->discounted_price) }} تومان</h6>
    </a>
    {{-- <a href="{{ route('shop.product.single', $cart->getModel()) }}" class="d-flex align-items-center my-4">
        <img src="{{ asset('/storage/' . $cart->getModel()->cover) }}" class="shadow rounded" style="max-height: 30px;"
            alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">{{ $cart->getModel()->name }}</h6>
            @if ($cart->getModel()->discountItem)
                <p class="text-muted mb-0">{{ number_format((int) $cart->getModel()->price) }}
                    هزار
                    تومان</p>
            @endif
        </div>
        <h6 class="text-dark mb-0">
            {{ number_format((int) $cart->getModel()->discounted_price) }} × {{ $cart->get('quantity') }} تومان
        </h6>
    </a> --}}
@else
    <a href="{{ route('course.single', $cart->getModel()) }}" class="d-flex align-items-center my-4">
        <img src="{{ asset('/storage/' . $cart->getModel()->image) }}" class="shadow rounded" style="max-height: 30px;"
            alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">{{ $cart->getModel()->title }}</h6>
            @if ($cart->getModel()->discountItem)
                <p class="text-muted mb-0">
                    {{ number_format((int) $cart->getModel()->price) }}
                    هزار
                    تومان</p>
            @endif
        </div>
        <h6 class="text-dark mb-0">
            {{ number_format((int) $cart->getModel()->discounted_price) }} تومان
        </h6>
    </a>
@endif

{{-- 
    TODO add discount on items
    TODO display count of product in cart
    FIXME fix price of course in cart
    TODO add discount on producgt
 --}}
