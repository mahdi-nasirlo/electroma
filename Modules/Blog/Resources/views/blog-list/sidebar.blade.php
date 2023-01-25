<div class="col-lg-4 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
    <div class="card border-0 sidebar sticky-bar rounded shadow">
        <div class="card-body">
            <!-- SEARCH -->
            <div class="widget">
                <form role="search" method="get">
                    <div class="input-group mb-3 border rounded">
                        <input type="text" id="s" name="search" value="{{ request('search') }}"
                            class="form-control border-0" placeholder="جستجوی کلمه کلیدی..." />
                        <button type="submit" class="input-group-text bg-transparent border-0" id="searchsubmit">
                            <x-font-search style="color: orangered" />
                        </button>
                    </div>
                </form>
            </div>
            <!-- SEARCH -->

            <!-- Categories -->
            <div class="widget mb-4 pb-2">
                <h5 class="widget-title">دسته بندیها</h5>
                <ul class="list-unstyled mt-4 mb-0 blog-categories">
                    @foreach ($cats as $cat)
                        @if ($cat->posts->count() > 0)
                            <li>
                                <a href="{{ route('blog.article.list', $cat) }}">
                                    {{ $cat->name }}
                                </a>
                                <span class="float-end">
                                    {{ $cat->posts->count() }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <!-- Categories -->

            <!-- پست های اخیر -->
            @if ($lastArticles = \Modules\Blog\Entities\Post::latest()->take(3))
                <div class="widget mb-4 pb-2">
                    <h5 class="widget-title">پست های اخیر</h5>
                    <div class="mt-4">
                        @foreach ($lastArticles->get() as $lastArticle)
                            <div class="clearfix post-recent d-flex items-center align-items-center">
                                <div class="post-recent-thumb float-start"> <a href="jvascript:void(0)"> <img
                                            alt="img" src="{{ asset('/storage/' . $lastArticle->image) }}"
                                            class="img-fluid rounded"></a>
                                </div>
                                <div class="post-recent-content float-start">
                                    <a href="{{ route('blog.article.single', $lastArticle) }}">
                                        {{ $lastArticle->title }}
                                    </a>
                                    <span class="text-muted mt-2">
                                        {{ jdate($lastArticle->created_at)->format('%d %B %Y') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- پست های اخیر -->

            <!-- TAG CLOUDS -->
            <div class="widget mb-4 pb-2">
                <h5 class="widget-title">برچسب های ابری</h5>
                <div class="tagcloud mt-4">
                    @foreach (\App\Models\Tag::all() as $tag)
                        <a href="jvascript:void(0)" class="rounded">
                            {{ json_decode($tag->name)->fa }}
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- TAG CLOUDS -->

            <!-- SOCIAL -->
            <div class="widget">
                <h5 class="widget-title">دنبال کردن ما</h5>
                <ul class="list-unstyled social-icon mb-0 ps-0 mt-2">
                    <a href="">
                        <x-font-instagram class="text-primary list-inline-item" />
                    </a>
                    <a href="">
                        <x-font-telegram class="text-primary list-inline-item" style="padding: 3px" />
                    </a>
                </ul>
                <!--end icon-->
            </div>
            <!-- SOCIAL -->
        </div>
    </div>
</div>
