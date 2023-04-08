@if ($banners->count())
    @foreach ($banners as $banner)
        <div class="col-6 col-sm-3 mt-3">
            @include('index.small-banner', [
                'banner' => $banner,
                'style' => 'width:100%;object-fit: fill;',
            ])
        </div>
    @endforeach
@else
    @for ($i = 0; $i < 4; $i++)
        <div class="col-3 mt-5">
            <img style="width: 100%; height: 100%;object-fit: fill ;border-radius: 7px; {{ $style ?? '' }}"
                data-src="{{ asset('/placeholder.webp') }}" alt="">
        </div>
    @endfor
@endif
