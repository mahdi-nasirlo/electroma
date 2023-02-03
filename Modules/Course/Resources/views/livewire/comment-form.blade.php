<div class="card rounded border my-4">
    <div class="card-body">
        <h5 class="card-title mb-0">ارسال نظر :</h5>
        @guest
            {{-- <div class="d-flex rounded text-white bg-amber-500 p-2 mt-3">
                      <div class="md:w-1/2 w-full font-semibold">برای ثبت دیدگاه وارد حساب کاربری شوید !</div>
                      <div class="md:w-1/2 w-full text-left">
                          <a href="#" class="text-white font-semibold">ورود / ثبت نام</a>
                      </div>
                  </div> --}}
            <div class="alert bg-warning d-flex justify-content-between mt-2" role="alert">
                <div class="md:w-1/2 w-full font-semibold text-white">برای ثبت دیدگاه وارد حساب کاربری شوید !</div>
                <div class="md:w-1/2 w-full text-left">
                    <a href="#" class="text-white font-semibold">ورود / ثبت نام</a>
                    <x-icon-o-arrow-sm-left class="text-white" />
                </div>
            </div>
        @endguest
        @auth
            @if (session()->has('message'))
                <div class="alert alert-success mt-2" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3 mt-4">
                        <label class="form-label">نظر شما</label>
                        <div class="form-icon position-relative">
                            <x-font-comment-o class="fea icon-sm icons" data-feather="message-circle" />
                            <textarea wire:model.lazy="comment" id="message" placeholder="کامنت شما" rows="5" name="content"
                                class="form-control ps-5 border border-slate-300 rounded focus:border-orange-400" required=""></textarea>
                            @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-md-12">
                    <div class="send d-grid">
                        <button wire:click='submitComment' id="send_comments" type="submit" class="btn btn-primary">
                            <span wire:loading.remove> ارسال پیام </span>
                            <span wire:loading> در حال پردازش </span>
                        </button>
                    </div>
                </div>
                <!--end col-->
            </div>
        @endauth
        <!--end form-->
    </div>
</div>
