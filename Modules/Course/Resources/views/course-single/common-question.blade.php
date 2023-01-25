<section style="padding: 40px 0" class="section bg-light">
    <div class="container-lg mt-40">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="section-title text-md-start text-center">
                    <h4 style="font-weight: 500" class="title mb-4">سر فصل های دوره {{ $course->title }}</h4>

                    <ul class="list-unstyled text-muted mt-4 mb-0">
                        @foreach ($course->attributes as $key => $value)
                            <li class="mb-0">
                                <span class="text-orange h5 me-2">
                                    <x-font-check-circle />
                                </span>
                                {{ $value['attribute'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="accordion" id="accordionExample">
                    @foreach ($course->common_questions as $question)
                        <div class="accordion-item rounded shadow mt-2">
                            <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                                <button class="accordion-button border-0 bg-white collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}"
                                    aria-expanded="true" aria-controls="collapse-{{ $loop->index }}">
                                    {{ $question['question'] }}
                                </button>
                            </h2>
                            <div id="collapse-{{ $loop->index }}" class="accordion-collapse border-0 collapse"
                                aria-labelledby="heading-{{ $loop->index }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body text-muted bg-white">
                                    {{ $question['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="row mt-5 pt-md-4 justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4"><span class="text-orange">سوالی دارید؟</span> در تماس باشید!</h4>
                    <p class="text-muted para-desc mx-auto">
                        شروع به کار با <span class="text-orange fw-bold">
                            {{ env('app_name') }} </span> می تواند هر آنچه را که شما برای ایجاد آگاهی ، ایجاد
                        مهارت ، کسب درآمد به آن
                        نیاز دارید فراهم کند.</p>
                    <a href="page-contact-two.html" class="btn btn-primary mt-4">
                        <x-font-phone /> تماس با ما
                    </a>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
