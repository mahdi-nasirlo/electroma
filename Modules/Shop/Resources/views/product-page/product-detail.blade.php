<section class="section pt-0 pb-0">
    <style>
        .tns-nav button {
            background: rgba(255, 147, 58, 0.578) !important;
        }

        .tns-nav button.tns-nav-active {
            background: rgb(255, 132, 0) !important;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
        }
    </style>

    <div class="container-xl mt-sm-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="pb-3 px-2 mt-4 mt-md-0 bg-white rounded-md shadow-sm">
                    <div class="row">
                        <div class="col-lg-5">
                            @include('shop::product-page.product-gallery')
                        </div>
                        <div class="col-lg-7">
                            <div class="section-title me-md-2">
                                <h4 class="title mt-5">
                                    {{ $product->name }}
                                </h4>
                                @if ($product->rate)
                                    <div class="d-flex justify-content-between">
                                        <ul class="list-unstyled text-warning h5 mb-0 d-flex p-0">
                                            @for ($i = 0; $i < 5; $i++)
                                                <li class="list-inline-item">
                                                    @if ($i > $product->rate - 1)
                                                        <x-font-star-o />
                                                    @else
                                                        <x-font-star />
                                                    @endif
                                                </li>
                                            @endfor
                                        </ul>

                                        (از {{ $product->comments()->count() }} نظر)
                                    </div>
                                @endif

                                @if ($product->short_desc)
                                    <h5 class="mt-4 py-2">بررسی:</h5>
                                    <p class="text-muted">
                                        {{ $product->short_desc }}
                                    </p>
                                @endif

                                <ul class="list-unstyled
                                        text-muted">
                                    @if ($product->short_information)
                                        @foreach ($product->short_information as $attribute)
                                            <li class="mb-0"><span class="text-primary h5 me-2">
                                                    <x-icon-o-check-circle />
                                                    </i>
                                                </span>
                                                {{ $attribute['name'] }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="p-2 bg-white rounded-md shadow-sm">
                    <div>
                        <span>
                            وضعیت کالا:
                        </span>

                        <span class="{{ $product->inventory > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $product->inventory > 0 ? 'موجود' : 'ناموجود' }}
                        </span>
                    </div>
                    <livewire:shop::product-page :product="$product" />
                </div>
                <!--end row-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->

    <div class="container-xl mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="shadow border rounded-md pt-4 bg-white">
                    <ul class="ms-0 ms-sm-2 nav nav-pills shadow flex-column flex-sm-row d-md-inline-flex mb-0 p-1 bg-white rounded position-relative overflow-hidden"
                        id="pills-tab" role="tablist">
                        <li class="nav-item m-1">
                            <a class="nav-link py-2 px-5 active rounded" id="description-data" data-bs-toggle="pill"
                                href="#description" role="tab" aria-controls="description" aria-selected="false">
                                <div class="text-center">
                                    <h6 class="mb-0">توضیحات </h6>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->

                        @if ($product->attributes()->count())
                            <li class="nav-item m-1">
                                <a class="nav-link py-2 px-5 rounded" id="additional-info" data-bs-toggle="pill"
                                    href="#additional" role="tab" aria-controls="additional" aria-selected="false">
                                    <div class="text-center">
                                        <h6 class="mb-0">اطلاعات تکمیلی</h6>
                                    </div>
                                </a>
                                <!--end nav link-->
                            </li>
                            <!--end nav item-->
                        @endif

                        <li class="nav-item m-1">
                            <a class="nav-link py-2 px-5 rounded" id="review-comments" data-bs-toggle="pill"
                                href="#review" role="tab" aria-controls="review" aria-selected="false">
                                <div class="text-center">
                                    <h6 class="mb-0">نظرات </h6>
                                </div>
                            </a>
                            <!--end nav link-->
                        </li>
                        <!--end nav item-->
                    </ul>

                    <div class="tab-content mt-5 py-3" id="pills-tabContent">
                        <div class="card border-0 tab-pane fade show active bg-white rounded-2 p-3 mb-2"
                            id="description" role="tabpanel" aria-labelledby="description-data">
                            <p class="text-muted mb-0">
                                {!! $product->content !!}
                            </p>
                        </div>

                        <div class="card border-0 tab-pane fade" id="additional" role="tabpanel"
                            aria-labelledby="additional-info">
                            <table class="table">
                                <tbody>
                                    @if ($product->attributes()->count())
                                        @foreach ($product->attributes as $attribute)
                                            <tr>
                                                <td style="width: 30%;">{{ $attribute->name }}</td>
                                                <td class="text-muted">{{ $attribute->pivot->value }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card shad p-3 rounded tab-pane fade bg-soft-primary mx-3" id="review"
                            role="tabpanel" aria-labelledby="review-comments">
                            <div class="row">
                                <div class="col-lg-6">
                                    <ul class="media-list list-unstyled mb-0 ps-0">
                                        @include('shop::product-page.each-comment')
                                    </ul>
                                </div>

                                <livewire:shop::comment-form :product='$product' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end container-->
    </div>
</section>
