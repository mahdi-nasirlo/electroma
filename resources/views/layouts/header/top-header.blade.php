<div class="bg-primary text-white">
    <div class=" container-xl d-flex justify-content-between">
        <div class="d-flex">
            <div class="d-flex">
                <span style="display:flex; align-items: center;">
                    <x-icon-o-phone class="mx-1" style="margin: 2px 0" />
                    تلفن پشتیبانی
                </span>
                <span class="d-none d-sm-flex px-1 mt-1">
                    {!! $information['mobile_support']['content'] !!}
                </span>
            </div>
            <div class="px-1 mt-1" style="direction: rtl">
                {!! $information['phone_support']['content'] !!}
            </div>
        </div>

        <div class="">
            <a style="display: flex;align-items: center;"class="text-white d-flex"
                href="{{ strip_tags($information['location']['content']) }}">

                <x-icon-o-location-marker class="mx-1" style="margin: 2px 0" />
                نشانی
                <span class="d-none d-sm-flex px-1">
                    {{ config('app.name') }}
                </span>
            </a>
        </div>
    </div>
</div>
