<div class="col-lg-3 col-md-4 col-12">
    <div class="card border-0 sidebar sticky-bar">
        <div class="card-body p-0">
            <!-- SEARCH -->
            <div class="widget">
                <form role="search" method="get">
                    <div class="input-group mb-3 border rounded">
                        <input wire:model='search' type="text" id="s" name="s"
                            class="form-control border-0" placeholder="جستجوی کلمه کلیدی...">
                        <button type="submit" class="input-group-text bg-white border-0" id="searchsubmit"><i
                                class="uil uil-search"></i></button>
                    </div>
                </form>
            </div>
            <!-- SEARCH -->

            <!-- Categories -->
            @if ($category->hasChilde())
                <div class="widget mt-4 pt-2">
                    <h5 class="widget-title">دسته بندیها </h5>
                    <ul class="list-unstyled mt-4 mb-0 blog-categories">
                        @foreach ($category->children as $item)
                            <li><a href="jvascript:void(0)">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Categories -->

            <!-- color -->

            {{-- @foreach ($category->attributes as $attribute)
                <div class="bg-light mt-4 p-3 pt-2 rounded-2 widget">
                    <h5 class="widget-title">{{ $attribute->name }}</h5>
                    <ul class="list-unstyled mt-4 mb-0 blog-categories">
                        @foreach ($attribute->values as $item)
                            <li>
                                <input name="ss" wire:model='filter' type="checkbox"
                                    value="{{ $item }}.{{ $attribute->name }}">
                                <a href="jvascript:void(0)">{{ $item }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach --}}


            @include('shop::product-list.sidbar-attribute-items')


            @php
                $topProducts = \Modules\Shop\Entities\Product::withCount('orders')
                    ->orderBy('orders_count', 'DESC')
                    ->take(4)
                    ->get();
            @endphp

            @if (\Modules\Payment\Entities\Order::count())
                <!-- Top Products -->
                <div class="widget mt-4 pt-2">
                    <h5 class="widget-title">محصولات برتر </h5>
                    <ul class="list-unstyled mb-0 p-0">
                        @foreach ($topProducts as $product)
                            <li class="d-flex align-items-center">
                                <a href="{{ route('shop.product.single', $product) }}">
                                    <img src="{{ $product->getCoverUrl() }}"
                                        class="img-fluid avatar avatar-small rounded shadow" style="height:auto;"
                                        alt="">
                                </a>
                                <div class="flex-1 content ms-3">
                                    <a href="{{ route('shop.product.single', $product) }}" class="text-dark h6">
                                        {{ $product->name }}
                                    </a>
                                    <h6 class="text-muted small fst-italic mb-0 mt-1">
                                        @if ($product->discountItem)
                                            <del class="text-danger ms-2">{{ number_format($product->price) }}</del>
                                            {{ number_format($product->discountedPrice) }}
                                            تومان
                                        @else
                                            {{ $product->price }}
                                        @endif

                                    </h6>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>
<!--end col-->

<!--
    FIXME product related category list of link
    TODO make limit for display to product with order count
-->
