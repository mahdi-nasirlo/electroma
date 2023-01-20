<div>
    <form wire:submit.prevent='saveinformation' class="mt-4">
        <div class="row">
            @if (session()->has('message'))
                <div style="margin-top: 10px" class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">نام تحویل گیرنده <span class="text-danger">*</span></label>
                    <input wire:model='name' name="name" id="firstname" type="text" class="form-control"
                        placeholder="نام اول :">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">آدرس خیابان <span class="text-danger">*</span></label>
                    <input wire:model='address' type="text" name="address1" id="address1" class="form-control"
                        placeholder="شماره خانه و نام خیابان :">
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">شهر / منطقه <span class="text-danger">*</span></label>
                    <input wire:model='city' type="text" name="city" id="city" class="form-control"
                        placeholder="نام شهر :">
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                </div>
            </div>
            <!--end col-->

            <!--end col-->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">منطقه <span class="text-danger">*</span></label>
                    <input wire:model='state' type="text" name="state" id="state" class="form-control"
                        placeholder="نام شهر :">
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                </div>
            </div>
            <!--end col-->

            <div class="col-12">
                <div class="mb-3">
                    <label class="form-label">تلفن همراه <span class="text-danger">*</span></label>
                    <input wire:model='mobile' type="text" name="phone" id="phone" class="form-control">
                    @if ($errors->has('mobile'))
                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">کد پستی <span class="text-danger">*</span></label>
                    <input wire:model='post' type="text" name="postcode" id="postcode" class="form-control"
                        placeholder="کد پستی :">
                    @if ($errors->has('post'))
                        <span class="text-danger">{{ $errors->first('post') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <!--end row-->
        <div class="mt-4 pt-2">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </div>
        </div>
        <!--end form-->
    </form>
</div>
