<div class="tab-pane fade bg-white shadow rounded p-4 {{ activeClassProfile('address') }}" id="address" role="tabpanel"
    aria-labelledby="addresses">
    <h6 class="text-muted mb-0">به طور پیش فرض آدرس زیر در صفحه پرداخت استفاده و قابل اصلاح می شود.</h6>

    <div class="row">
        <div class="col-12 mt-4 pt-2">
            <div class="d-flex align-items-center mb-4 justify-content-between">
                <h5 class="mb-0"> آدرس:</h5>
                {{-- <a id="toggle" toggle="false" href="javascript:void(0)" class="text-primary h5 mb-0"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Edit"><i
                        class="uil uil-edit align-middle"></i></a> --}}
            </div>
            <div class="pt-4 border-top">
                <div style="display: block" id="addresinfo">
                    @php
                        $user = auth()->user();
                    @endphp
                    <p class="h6">{{ $user->last_name }}</p>
                    <p class="h6 text-muted">{{ $user->city . ' --- ' . $user->state }}</p>
                    <p class="h6 text-muted">{{ $user->address }}</p>
                    <p class="h6 text-muted">
                        @if ($user->post)
                            {{ $user->post }} کد پستی :
                        @endif
                    </p>
                    <p class="h6 text-muted mb-0">{{ $user->mobile }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
<!--end teb pane-->
