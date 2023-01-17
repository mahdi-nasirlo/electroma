<!-- Hero Start -->
<section class="bg-half bg-light d-table w-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="page-next-level">
                    <h4 class="title"> {{ isset($name) ? $name : 'وبلاگ' }} </h4>
                    @if (isset($article))
                        <ul class="list-unstyled mt-4">
                            <li class="list-inline-item h6 user text-muted me-2"><i class="mdi mdi-account"></i>
                                {{ $article->user->name }}
                            </li>
                            <li class="list-inline-item h6 date text-muted"><i class="mdi mdi-calendar-check"></i>
                                {{ jdate($article->creeated_at)->format('%d %B %Y') }}
                            </li>
                        </ul>
                    @endif
                    @if (isset($category))
                        @include('blog::hero.navigation-hero', ['category' => $category])
                    @endif
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end section-->
<!-- Hero End -->

<!-- Shape Start -->
<div class="position-relative">
    <div class="shape overflow-hidden text-white">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
<!--Shape End-->
