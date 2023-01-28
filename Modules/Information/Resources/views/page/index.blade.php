@extends('layouts.master')

@section('script')
@endsection

@section('content')
    @include('blog::hero.index', ['name' => $page->name, 'string' => 'لینک مفید'])


    <!-- Blog Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                {!! $page->content !!}
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- Blog End -->
@endsection
