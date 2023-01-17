@extends('layouts.master')

@section('script')
@endsection

@section('content')
    @include('blog::hero.index', ['name' => $category->name])

    <!-- Blog Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                @include('blog::blog-list.blog-list')


                @include('blog::blog-list.sidebar', [
                    'cats' => \Modules\Blog\Entities\Category::latest()->get(),
                ])

            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- Blog End -->
@endsection
