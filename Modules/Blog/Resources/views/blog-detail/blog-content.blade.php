<div class="col-lg-9 col-12">
    <div class="card blog blog-detail border rounded">
        <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded-top" alt="">
        <div class="card-body content">
            <div class="d-flex justify-between">
                <h6>

                    <x-icon-o-tag style="color: rgb(255, 135, 23)" />
                    @foreach ($article->tags as $item)
                        <a href="javscript:void(0)" class="text-primary px-2">
                            {{ $item->name }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </h6>
            </div>
        </div>
        <div class="px-4 card-body content">
            {!! $article->content !!}
        </div>
    </div>
    @include('blog::blog-detail.related', [
        'related' => \Modules\Blog\Entities\Post::all()->where('blog_category_id', $article->category->id)->take(2),
        //    'lastArticles' => \Modules\Blog\Entities\Post::latest()->take(5)->get(),
    ])
    <livewire:blog::comment :model="$article" />
</div>
