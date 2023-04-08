<div class="row my-4">
    @if ($banners->count())
        @foreach ($banners as $banner)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ $banner->getLink() }}">
                    <div class="d-flex my-2 me-1">
                        <div
                            class="w-100 card border-0 text-center features feature-clean course-feature p-2 overflow-hidden shadow">
                            <div class="icons text-primary text-center mx-auto">
                                <img width="80" height="80" data-src="{{ asset('/storage/' . $banner->path) }}"
                                    alt="">
                            </div>
                            <div class="card-body p-0 mt-2">
                                <a class="title h5 text-dark ">
                                    {{ $banner->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @else
        @for ($i = 0; $i < 4; $i++)
            <div class="col-3">
                <div
                    class="w-100 card border-0 text-center features feature-clean course-feature p-2 overflow-hidden shadow">
                    <div class="icons text-primary text-center mx-auto">
                        <img width="80" height="80" data-src="/placeholder.webp" alt="">
                    </div>
                </div>
            </div>
        @endfor
    @endif
</div>
</div>
