@extends('errors.layout')


@section('content')
    <!-- ERROR PAGE -->
    <section class="bg-home d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 text-center">
                    <img data-src="{{ asset('/static/404.svg') }}" class="img-fluid" alt="">
                    <div class="text-uppercase display-3">
                        <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                            @yield('code')
                        </div>
                    </div>
                    <div class="text-capitalize text-dark error-page">
                        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                            @yield('message')
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
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
