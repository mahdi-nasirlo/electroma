        <!-- Hero Start -->
        <section class="bg-half-170 py-5 border-bottom d-table w-100" id="home">
            <div class="container-xlg px-2 mx-sm-3">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7">
                        <div class="title-heading mt-4">
                            <div class="alert alert-white alert-pills shadow mb-1" role="alert">
                                @if ($course->discountItem)
                                    <span class="badge rounded-pill bg-danger me-1">%
                                        {{ $course->discountItem->percent }}
                                    </span>
                                    <span class="content">
                                        <del class="mx-2">
                                            {{ number_format($course->price) }}
                                        </del>
                                        <span class="text-primary">
                                            {{ number_format($course->discounted_price) }}
                                        </span>
                                        تومان
                                    </span>
                                @else
                                    <span class="content">
                                        <span class="text-primary">
                                            {{ number_format($course->discounted_price) }}
                                        </span>
                                        تومان
                                    </span>
                                @endif
                            </div>
                            <h1 class="heading mb-3">
                                {{ $course->title }}
                                {{-- پیشرو در تجارت دیجیتال برای --}}
                                {{-- <span class="text-primary typewrite" data-period="2000"
                                    data-type='[ "آژانسی", "نرم افزار", "تکنولوژی", "استدیو", "اپ وب" ]'>
                                    <span class="wrap"></span>
                                </span> --}}
                                {{-- با بهترین امکانات --}}
                            </h1>
                            @if ($course->short_desc)
                                <p class="para-desc text-muted">
                                    {{ $course->short_desc }}
                                </p>
                            @endif
                            <div class="mt-4">
                                <livewire:course::cart :course="$course" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                        <div class="position-relative pt-3">
                            <img src="{{ asset('/storage/' . $course->image) }}"
                                class="rounded img-fluid mx-auto d-block" alt="">
                            {{-- <div class="play-icon">
                                <a href="#!" data-type="youtube" data-id="yba7hPeTSjk" class="play-btn lightbox">
                                    <i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
                                </a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
