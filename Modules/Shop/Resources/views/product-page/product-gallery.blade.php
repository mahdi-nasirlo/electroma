@if ($product->gallery)

    <div class="tiny-single-item">
        @foreach ($product->gallery as $gallery)
            <div class="tiny-slide tns-item" id="tns1-item{{ $loop->index }}"
                @if (!$loop->first) aria-hidden="true" @endif tabindex="-1">
                <img src="{{ $gallery->getUrl() }}" style="width: 100%" class="img-fluid rounded" alt="">
            </div>
        @endforeach
    </div>
@endif

{{-- 
    FIXME fix shop categoryes in admin
--}}
