{{-- @php
    $banner = \App\Models\Banner::where('collection', 'small-banner')->first();
@endphp --}}

@if ($banner)
    <a href="{{ $banner->getLink() }}">
        <img style="width: 100%;height: 100%;object-fit: cover;border-radius: 7px; {{ $style ?? '' }}"
            src="/storage/{{ $banner->path }}" alt="">
    </a>
@else
    <img class="w-100" style="height: 100%;object-fit: cover;border-radius: 7px; {{ $style ?? '' }}"
        src="/placeholder.webp" alt="">
@endif
