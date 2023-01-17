@extends('layouts.master')

@section('content')
    @include('blog::hero.index', ['name' => $article->title, 'category' => $article->category])

    <section style="padding: 60px 0">
        <div class="container-sm">
            <div class="row">

                @include('blog::blog-detail.blog-content')

                @include('blog::blog-detail.sidebar', [
                    'cats' => \Modules\Blog\Entities\Category::with('posts')->latest()->get(),
                ])

            </div>
        </div>
    </section>
@endsection
