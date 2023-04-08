@php
    $nextRecorde = \Modules\Shop\Entities\Product::where('id', '>', $product->id)
        ->orderBy('id')
        ->first();
    $preRecorde = \Modules\Shop\Entities\Product::where('id', '<', $product->id)
        ->orderBy('id')
        ->first();
@endphp
@if ($nextRecorde and $preRecorde)
    <div class="container-fluid mt-100 mt-60 px-0">
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            @if ($nextRecorde)
                                <a href="{{ route('shop.product.single', $nextRecorde) }}"
                                    class="text-dark align-items-center">
                                    <span class="pro-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-arrow-right fea icon-sm">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                    <span class="text-muted d-none d-md-inline-block">{{ $nextRecorde->name }}</span>
                                    <img data-src="{{ $nextRecorde->getCoverUrl() }}"
                                        class="avatar avatar-small rounded shadow ms-2" style="height:auto;"
                                        alt="">
                                </a>
                            @endif

                            <a href="{{ route('home') }}" class="btn btn-lg btn-pills btn-icon btn-soft-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-home icons">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                            </a>

                            @if ($preRecorde)
                                <a href="{{ route('shop.product.single', $preRecorde) }}"
                                    class="text-dark align-items-center">
                                    <img data-src="{{ $preRecorde->getCoverUrl() }}"
                                        class="avatar avatar-small rounded shadow me-2" style="height:auto;"
                                        alt="">
                                    <span class="text-muted d-none d-md-inline-block">{{ $preRecorde->name }}</span>

                                    <span class="pro-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-arrow-left fea icon-sm">
                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                            <polyline points="12 19 5 12 12 5"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
        <!--end div-->
    </div>

@endif
