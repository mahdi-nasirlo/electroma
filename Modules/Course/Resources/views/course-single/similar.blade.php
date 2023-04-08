@if ($papular->count() >= 2)
    <div class="container mt-5 pt-3">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4">
                    <h4 class="title mb-4">کاووش دوره های محبوب </h4>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row">
            @foreach ($papular as $item)
                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2 mb-5">
                    <div class="card courses-desc overflow-hidden rounded shadow border-0">
                        <div class="position-relative d-block overflow-hidden">
                            <img data-src="{{ asset('/storage/' . $item->image) }}" class="img-fluid rounded-top mx-auto"
                                alt="">
                            <div class="overlay-work bg-dark"></div>
                            <a href="javascript:void(0)" class="text-white h6 preview">نمایش <i
                                    class="uil uil-angle-left-b align-middle"></i></a>
                        </div>

                        <div class="card-body">
                            <h5><a href="javascript:void(0)" class="title text-dark">{{ $item->title }}</a></h5>
                            <div class="fees d-flex justify-content-between">
                                <ul class="list-unstyled mb-0 numbers ps-0">
                                    <li>
                                        <x-icon-o-users class="text-muted" />
                                        30 کار آموز
                                    </li>
                                    <li>
                                        <x-icon-o-document-duplicate class="text-muted" />
                                        {{ count($item->attributes) }}
                                        درس
                                    </li>
                                </ul>
                                <h4><span class="h6">{{ number_format($item->price) }} </span> تومان </h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!--end col-->
        </div>
        <!--end row-->
    </div>
@endif
