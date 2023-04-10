<div class="container mb-5">
    <div class="row">
        <div class="col-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
            <div class="card shadow border-0 py-2 h-100 rounded-md text-center features feature-clean">
                <div class="icons text-primary text-center mx-auto">
                    <x-font-phone class="uil uil-phone d-block rounded h3 mb-0" style="width: 40px; height: 40px;" />
                </div>
                <div class="content mt-3">
                    <h5 class="fw-bold">تلفن </h5>
                    <a href="tel:{{ strip_tags(Helper::information('mobile_support')) }}"
                        class="text-primary">{!! Helper::information('mobile_support') !!}</a>
                </div>
            </div>
        </div>
        <!--end col-->

        <div class="col-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
            <div class="card shadow border-0 py-2 h-100 rounded-md text-center features feature-clean">
                <div class="icons text-primary text-center mx-auto">
                    <x-font-location-arrow class="uil uil-map-marker d-block rounded h3 mb-0"
                        style="width: 40px; height: 40px;" />
                </div>
                <div class="content mt-3">
                    <h5 class="fw-bold">موقعیت </h5>
                    <p class="text-muted">
                        {!! Helper::information('location_text') !!}
                    </p>
                    <a href="{{ strip_tags(Helper::information('location')) }}" data-type="iframe"
                        class="video-play-icon text-primary lightbox">نمایش در گوگل</a>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
