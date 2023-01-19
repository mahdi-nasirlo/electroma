@if ($product->gallery)

    <div class="tiny-single-item">
        @foreach ($product->gallery as $gallery)
            <div class="tiny-slide tns-item" id="tns1-item{{ $loop->index }}"
                @if (!$loop->first) aria-hidden="true" @endif tabindex="-1">
                <img src="{{ $gallery->getUrl() }}" style="width: 100%" class="img-fluid rounded" alt="">
            </div>
        @endforeach
    </div>

    {{-- <div class="tns-outer" id="tns1-ow">
        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span
                class="current">4</span> of 5</div>
        <div id="tns1-mw" class="tns-ovh">
            <div style="margin: 0" class="tns-inner" id="tns1-iw">
                <div class="tiny-single-item  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                    id="tns1" style="transform: translate3d(-60%, 0px, 0px);">
                    @foreach ($product->gallery as $gallery)
                        <div class="tiny-slide tns-item" id="tns1-item{{ $loop->index }}"
                            @if (!$loop->first) aria-hidden="true" @endif tabindex="-1">
                            <img src="{{ $gallery->getUrl() }}" style="width: 100%" class="img-fluid rounded"
                                alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="customize-thumbnails"></div>
    </div> --}}
@endif

{{-- 
    FIXME fix shop categoryes in admin
--}}
