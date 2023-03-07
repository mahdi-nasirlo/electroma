<div class="tiny-three-item mt-5">
    @if ($banners->count() > 0)
        @foreach ($banners as $banner)
            <div class="tiny-slide">
                <div style="flex-direction: column;margin-right: 1px;"
                    class="bg-white mb-2 me-1 d-flex justify-content-center rounded shadow category-banner">
                    <img style="margin: 0 auto;max-width: 80px; max-height: 80px;" src="/storage/{{ $banner->path }}"
                        alt="">
                    <span class="text-center">{{ $banner->bannerable->name }}</span>
                </div>
            </div>
        @endforeach
    @else
        @for ($i = 0; $i < 10; $i++)
            <div class="tiny-slide rounded-md">
                <img class="rounded-md" style="object-fit: cover; width: 100%" src="/placeholder.webp" alt="">
            </div>
        @endfor
    @endif
</div>
