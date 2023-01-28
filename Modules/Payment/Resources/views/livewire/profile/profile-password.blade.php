<div>
    <form wire:submit.prevent='savePassword'>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">رمز عبور قدیمی : </label>
                    <div class="form-icon position-relative">
                        <x-icon-o-lock-closed data-feather="key" class="fea icon-sm icons" />
                        <input wire:model='password' type="password" class="form-control ps-5" placeholder="رمز قدیمی">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">رمز عبور جدید : </label>
                    <div class="form-icon position-relative">
                        <x-icon-o-lock-closed data-feather="key" class="fea icon-sm icons" />
                        <input wire:model='newPassword' type="password" class="form-control ps-5"
                            placeholder="رمز جدید">
                        @if ($errors->has('newPassword'))
                            <span class="text-danger">{{ $errors->first('newPassword') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-12">
                <div class="mb-3">
                    <label class="form-label">تایید رمز عبور جدید : </label>
                    <div class="form-icon position-relative">
                        <x-icon-o-lock-closed data-feather="key" class="fea icon-sm icons" />
                        <input wire:model='confirmationPassword' type="password" class="form-control ps-5"
                            placeholder="رمز عبور جدید">
                        @if ($errors->has('confirmationPassword'))
                            <span class="text-danger">{{ $errors->first('confirmationPassword') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!--end col-->

            @if (session()->has('message'))
                <div style="margin-top: 10px" class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div style="margin-top: 10px" class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="col-lg-12 mt-2 mb-0">
                <button type="submit" class="btn btn-primary">ذخیره رمز عبور </button>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>

</div>
