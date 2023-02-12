<div @guest style="padding-right: 0" @endguest class="col-lg-6 mt-4 mt-lg-0 pt-2 pt-lg-0">
    <style>
        .check-login {
            position: absolute;
            width: 100%;
            height: 100%;
            text-align: center;
            z-index: 10;
            /* background: rgb(0 112 255 / 4%); */
            border-radius: 5px;
            font-weight: 600;
            font-size: 18px;
            line-height: 450px
        }
    </style>
    @guest
        <div class="check-login bg-soft-blue">
            <div style="font: 20px" class="text-orange">
                برای ثبت نظر لطفا وارد شوید.
            </div>
        </div>
    @endguest
    <div @guest style="filter: blur(6px); margin: 15px 0" @endguest class="ms-lg-4">
        <div @guest style="margin: 6px" @endguest class="row">
            <div class="col-12">
                <h5>اضافه کردن نظر:</h5>
            </div>
            @if (session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-12 mt-4">
                <h6 class="small fw-bold">امتیاز شما :</h6>
                <div>
                    <div>
                        <x-shop::rating-input />
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="mb-3">
                    <label class="form-label">نظر شما:</label>
                    <div class="form-icon position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-message-circle fea icon-sm icons">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        <textarea wire:model.lazy="comment" id="message" placeholder="کامنت شما" rows="5" name="message"
                            class="form-control ps-5" required=""></textarea>
                        @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-12">
                <div class="send d-grid">
                    <button wire:click='submitComment' type="button" class="btn btn-primary">
                        <span wire:loading.remove> ارسال پیام </span>
                        <span wire:loading> در حال پردازش </span>
                    </button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end form-->
</div>
