<div style="height: fit-content" class="col-lg-3 col-md-4 col-12 bg-white shadow rounded-md">
    <div class="card border-0 sidebar my-2">
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
                    <h5 class="widget-title">دسته بندی ها </h5>
                    <ul class="list-unstyled mt-4 mb-0 blog-categories">
                        @foreach ($category->children as $item)
                            <li><a href="{{ route('shop.product.list', $item) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Categories -->

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
