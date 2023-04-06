<div>
    <div>
        @include('shop::navigation.navigation-hero', [
            'category' => isset($category) ? $category : null,
        ])
        <section class="section pt-md-3">
            <div class="container">
                <div class="row">
                    @include('shop::product-list.sidebar')

                    <div class="col-lg-9 col-md-8 col-12 mt-5 pt-2 mt-sm-0 pt-sm-0">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-7 d-flex align-item-center">
                                {{ $products->links('shop::vendor.livewire.tailwind') }}
                            </div>
                            <!--end col-->



                            <div class="col-lg-4 col-md-5 mt-4 mt-sm-0 pt-2 pt-sm-0">
                                <div class="d-flex justify-content-md-between align-items-center">
                                    <div class="form custom-form">
                                        <div class="mb-0">
                                            <select wire:model='order' class="form-select form-control"
                                                aria-label="Default select example" id="Sortbylist-job">
                                                <option value="last" selected="">مرتب سازی بر اساس آخرین</option>
                                                <option value="popular">مرتب سازی بر اساس پر فروش ترین</option>
                                                <option value="rating">مرتب سازی بر اساس پیشنهاد کاربران</option>
                                                <option value="priceASC">مرتب سازی بر اساس قیمت: کم به زیاد</option>
                                                <option value="priceDEC">مرتب سازی بر اساس قیمت: زیاد به کم</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- <div class="mx-2">
                                    <a href="shop-grids.html" class="h5 text-muted"><i class="uil uil-apps"></i></a>
                                </div>

                                <div>
                                    <a href="shop-lists.html" class="h5 text-muted"><i class="uil uil-list-ul"></i></a>
                                </div> --}}
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->


                        <div wire:loading.block>
                            @include('shop::components.skelton')
                        </div>
                        <div wire:loading.remove>

                            <div class="row">
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-6 mt-4 pt-2">
                                            <livewire:shop::product-cart :product="$product" />
                                        </div>
                                    @endforeach
                                @else
                                    محصولی برای نمایش وجود ندارد
                                @endif


                            </div>


                            <div>
                                {{ $products->links('shop::vendor.livewire.bootstrap') }}
                            </div>

                        </div>
                        <!--end row-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        @if ($category->description)
            <div class="px-4 mx-0 mx-sm-4 bg-light shadow card-body content">
                {!! $category->description !!}
            </div>
        @endif
    </div>

    {{-- 
    TODO add rating filter
    TODO add papular filter
    TODO add more product sale in product list sidebar
    TODO fix product cart 
    FIXME fix brudcump on title
    FIXME fix category filter links
--}}

</div>
