<div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive bg-white shadow">
                <table class="table table-center table-padding mb-0">
                    <thead>
                        <tr>
                            <th class="border-bottom py-3"></th>
                            <th class="border-bottom py-3">عکس محصول </th>
                            <th class="border-bottom ps-6">محصول </th>
                            <th class="border-bottom text-center py-3">قیمت </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            @if ($cartItem->getModel() instanceof \Modules\Shop\Entities\Product)
                                <tr class="shop-list">
                                    <td class="h6"><a href="#"
                                            wire:click.prevent="removeCart('{{ $cartItem->getHash() }}')"
                                            class="text-danger">
                                            <span wire:loading.remove>X</span>
                                            <div wire:loading style="width: 20px;height: 20px"
                                                class="spinner-border text-danger" role="status">
                                            </div>
                                        </a>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('shop.product.single', $cartItem->getModel()) }}">
                                            <img src="{{ $cartItem->getModel()->getCoverUrl() }}" class="shadow rounded"
                                                style="max-width: 200px;" alt="{{ $cartItem->getModel()->name }}">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <h6 class="mb-0 me-3">
                                                <a href="{{ route('shop.product.single', $cartItem->getModel()) }}">
                                                    {{ $cartItem->getModel()->name }}
                                                </a>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold">
                                        <small style="color: gray">
                                            {{ $cartItem->get('quantity') }} عدد
                                        </small>

                                        <del class="text-danger">{{ number_format($cartItem->getModel()->price) }}</del>
                                        {{ number_format($cartItem->getModel()->discounted_price) }} تومان
                                    </td>
                                </tr>
                            @else
                                <tr class="shop-list">
                                    <td class="h6"><a href="#"
                                            wire:click.prevent="removeCart('{{ $cartItem->getHash() }}')"
                                            class="text-danger">
                                            <span wire:loading.remove>X</span>
                                            <div wire:loading style="width: 20px;height: 20px"
                                                class="spinner-border text-danger" role="status">
                                            </div>
                                        </a>
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('course.single', $cartItem->getModel()) }}">
                                            <img src="{{ asset('/storage/' . $cartItem->getModel()->image) }}"
                                                class="shadow rounded" style="max-width: 200px;"
                                                alt="{{ $cartItem->getModel()->title }}">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <h6 class="mb-0 me-3">
                                                <a href="{{ route('course.single', $cartItem->getModel()) }}">
                                                    {{ $cartItem->getModel()->title }}
                                                </a>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold">
                                        <del
                                            class="text-danger">{{ number_format($cartItem->getModel()->price) }}</del>
                                        {{ number_format($cartItem->getModel()->discounted_price) }} تومان
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>
