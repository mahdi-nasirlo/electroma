<div style="display: flex;" class="tiny-five-item">
    @if ($banners->count() > 0)
        @foreach ($banners as $banner)
            <div class="tiny-slide rounded-md">
                <a href="{{ $banner->getLink() }}">
                    <img class="rounded-md" style="height: auto;object-fit: cover; width: 100%"
                        src="/storage/{{ $banner->path }}" alt="">
                </a>
            </div>
        @endforeach
    @else
        @for ($i = 0; $i < 2; $i++)
            <div class="tiny-slide rounded-md">
                <img class="rounded-md" style="height: auto;object-fit: cover; width: 100%" src="/placeholder.webp"
                    alt="">
            </div>
        @endfor
    @endif
</div>
