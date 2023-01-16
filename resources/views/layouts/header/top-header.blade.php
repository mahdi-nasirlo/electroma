<div class="bg-primary text-white">
    <div class=" container-xl d-flex justify-content-between">
        <div class="d-flex">
            <div class="d-flex">
                <span style="display:flex; align-items: center;">
                    <i class="uil uil-phone"></i>
                    تلفن پشتیبانی
                </span>
                <span class="d-none d-sm-flex px-1">
                    {{-- {!! $information['mobile_support']['content'] !!} --}}
                </span>
            </div>
            <div class="px-1" style="direction: rtl">
                {{-- {!! $information['phone_support']['content'] !!} --}}
            </div>
        </div>

        <div style="display: flex;align-items: center;" class="">
            <a class="text-white d-flex">
                {{-- href="{{ strip_tags($information['location']['content']) }}" --}}
                <i class="uil uil-location-point"></i>
                نشانی
                <span class="d-none d-sm-flex px-1">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>
    </div>
</div>
