<footer class="footer">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    {{-- <img src="images/logo-light.png" alt="" height="24"> --}}
                </a>
                <p class="mt-4">
                    {!! Helper::information('footer_goal') !!}
                </p>
                <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">

                    <li class="list-inline-item">
                        <a href="{{ strip_tags(Helper::information('instagram_link')) }}" class="rounded">
                            <x-font-instagram class="list-inline-item fill-white"
                                style="padding: 3px; margin-right: 4px" />
                        </a>
                    </li>
                    <li class="list-inline-item"><a href="{{ strip_tags(Helper::information('telegram_link')) }}"
                            class="rounded">
                            <x-font-telegram class="list-inline-item fill-white"
                                style="padding: 3px; margin-right: 4px" />
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ strip_tags(Helper::information('aparat_link')) }}" class="rounded">
                            <x-font-aparat class="list-inline-item fill-white" style="padding: 1px" />

                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ strip_tags(Helper::information('whatsapp_link')) }}" class="rounded">
                            <x-font-whatsapp class="text-white list-inline-item fill-white" style="padding: 1px" />
                        </a>
                    </li>
                </ul>
                <!--end icon-->
            </div>
            <!--end col-->

            @php
                $categoreis = Modules\Blog\Entities\Category::all()
                    ->where('is_visible', true)
                    ->where('parent_id', 0)
                    ->take(5);
            @endphp

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">بلاگ </h5>
                <ul class="list-unstyled footer-list mt-4">

                    @foreach ($categoreis as $category)
                        <li>
                            <a href="{{ route('blog.article.list', $category) }}" class="text-foot">
                                <i class="uil uil-angle-left-b me-1"></i>
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">لینک های مفید </h5>
                <ul class="list-unstyled footer-list mt-4">
                    @php
                        $pages = Modules\Information\Entities\Page::all();
                    @endphp
                    @foreach ($pages as $page)
                        <li>
                            <a href="{{ route('pages', $page) }}" class="text-foot">
                                <i class="uil uil-angle-left-b me-1"></i>
                                {{ $page->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">خبرنامه </h5>
                <p class="mt-4">ثبت نام کنید و آخرین نکات را از طریق ایمیل دریافت کنید.</p>
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="foot-subscribe mb-3">
                                <label class="form-label">ایمیل خود را بنویسید <span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-mail fea icon-sm icons">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                    <input type="email" name="email" id="emailsubscribe"
                                        class="form-control ps-5 rounded" placeholder="ایمیل شما: " required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-grid">
                                <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary"
                                    value="خبرنامه">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</footer>
