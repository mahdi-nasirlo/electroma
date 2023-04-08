<div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive bg-white shadow">
                <table class="table table-center table-padding mb-0">
                    <thead>
                        <tr>
                            <th class="border-bottom py-3" style="min-width:20px "></th>
                            <th class="border-bottom py-3" style="min-width: 300px;">محصول </th>
                            <th class="border-bottom text-center py-3" style="min-width: 160px;">قیمت </th>
                            <th class="border-bottom text-center py-3" style="min-width: 160px;">تعداد </th>
                            <th class="border-bottom text-center py-3" style="min-width: 160px;">مجموع </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            @if ($cartItem->getModel() instanceof \Modules\Shop\Entities\Product)
                                <livewire:payment::cart.cart-item :cartItem="$cartItem->getModel()->id" :hash="$cartItem->getHash()" />
                            @else
                                <tr class="shop-list">
                                    <td class="h6">
                                        <a href="#" wire:click.prevent="removeCart('{{ $cartItem->getHash() }}')"
                                            class="text-danger">
                                            <span wire:loading.remove>X</span>
                                            <div wire:loading style="width: 20px;height: 20px"
                                                class="spinner-border text-danger" role="status">
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('course.single', $cartItem->getModel()) }}">
                                                <img src="{{ asset('/storage/' . $cartItem->getModel()->image) }}"
                                                    alt="{{ $cartItem->getModel()->title }}"
                                                    class="img-fluid avatar avatar-small rounded shadow"
                                                    style="height:auto;">
                                            </a>
                                            <a class="text-secendry mx-2 text-body"
                                                href="{{ route('course.single', $cartItem->getModel()) }}">
                                                دوره {{ $cartItem->getModel()->title }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($cartItem->getModel()->discounted_price != $cartItem->getModel()->price)
                                            <del class="text-danger">
                                                {{ number_format($cartItem->getModel()->price) }}
                                            </del>

                                            {{ number_format($cartItem->getModel()->discounted_price) }}
                                            تومان
                                        @else
                                            {{ number_format($cartItem->getModel()->price) }} تومان
                                        @endif
                                    </td>
                                    <td class="text-center qty-icons">
                                        <button disabled class="btn btn-icon btn-soft-primary minus">-</button>
                                        <input disabled min="1" value="1" name="quantity" type="number"
                                            class="btn btn-icon btn-soft-primary qty-btn quantity">
                                        <button disabled class="btn btn-icon btn-soft-primary plus">+</button>
                                    </td>
                                    <td class="text-center fw-bold">
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
