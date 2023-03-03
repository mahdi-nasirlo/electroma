@extends('layout.master')


@section('content')
    <!-- ERROR PAGE -->
    <section style="margin: 150px 0" class="bg-home d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 text-center">
                    <img src="/theme/images/404.svg" class="img-fluid" alt="">
                    <div class="text-uppercase mt-4 display-3">
                        <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                            @yield('code')
                        </div>
                    </div>
                    <div class="text-capitalize text-dark mb-4 error-page">
                        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                            @yield('message')
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row p-3">
                <div class="col-md-12 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary mt-4">برو عقب</a>
                    <a href="/" class="btn btn-primary mt-4 ms-2">برو صفحه اصلی </a>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- ERROR PAGE -->
@endsection
