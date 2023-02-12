{{-- <div class="col-lg-12 mt-4">
    <div class="tns-outer disabled-pagination" id="tns1-ow">
        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">2
                to 4</span> of 6</div>
        <div id="tns1-mw" class="tns-ovh">
            <div class="tns-inner w-100" id="tns1-iw">
                <div class="tiny-three-item  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                    id="tns1" style="transform: translate3d(-16.6667%, 0px, 0px);">
                    @foreach ($banners as $banner)
                        <div class="tiny-slide tns-item" id="tns1-item{{ $loop->index }}" aria-hidden="true"
                            tabindex="-1">
                            <div class="d-flex my-2 me-1">
                                <div
                                    class="w-100 card border-0 text-center features feature-clean course-feature p-2 overflow-hidden shadow">
                                    <div class="icons text-primary text-center mx-auto">
                                        <img width="80" height="80" src="/storage/{{ $banner->path }}"
                                            alt="">
                                    </div>
                                    <div class="card-body p-0 mt-2">
                                        <a href="{{ route('product.list', $banner->bannerable) }}"
                                            class="title h5 text-dark ">
                                            {{ $banner->bannerable->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="tiny-three-item mt-5">
    @if ($banners->count() > 0)
        @foreach ($banners as $banner)
            <div class="tiny-slide rounded-md">
                <div style="flex-direction: column;" class="bg-white mb-2 me-1 d-flex justify-content-center shadow">
                    <img style="margin: 0 auto;max-width: 80px; max-height: 80px;" class="rounded-md"
                        src="/storage/{{ $banner->path }}" alt="">
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
