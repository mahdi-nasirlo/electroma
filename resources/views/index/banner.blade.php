@if ($banners->count())
    @foreach ($banners as $banner)
        <div class="col-12 col-sm-6 mt-3">
            @include('home.index.small-banner', [
                'banner' => $banner,
                'style' => 'max-height: 220px;width:100%;object-fit: cover;',
            ])
        </div>
    @endforeach
@else
    @for ($i = 0; $i < 4; $i++)
        <div class="col-3 mt-5">
            <img style="width: 100%; height: 100%;object-fit: cover;border-radius: 7px; {{ $style ?? '' }}"
                src="/placeholder.webp" alt="">
        </div>
    @endfor
@endif
