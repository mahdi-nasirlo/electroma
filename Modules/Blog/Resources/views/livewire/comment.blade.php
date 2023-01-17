<div>
    <div>
        <div>
            <div class="card rounded border my-4">
                <div class="card-body">
                    <h5 class="card-title mb-0">ارسال نظر :</h5>
                    @guest
                        {{-- <div class="d-flex rounded text-white bg-amber-500 p-2 mt-3">
                      <div class="md:w-1/2 w-full font-semibold">برای ثبت دیدگاه وارد حساب کاربری شوید !</div>
                      <div class="md:w-1/2 w-full text-left">
                          <a href="#" class="text-white font-semibold">ورود / ثبت نام</a>
                          <i class="fas fa-arrow-left"></i>
                      </div>
                  </div> --}}
                        <div class="alert bg-warning d-flex justify-content-between mt-2" role="alert">
                            <div class="md:w-1/2 w-full font-semibold text-white">برای ثبت دیدگاه وارد حساب کاربری شوید !
                            </div>
                            <div class="md:w-1/2 w-full text-left">
                                <a href="#" class="text-white font-semibold">ورود / ثبت نام</a>
                                <i class="fas fa-arrow-left"></i>
                            </div>
                        </div>
                    @endguest
                    @auth
                        <div id="successMs" style="display: none" class="md:flex rounded text-white bg-green-400 p-2 mt-3">
                            <div class=" w-full font-semibold">دیدگاه شما با موفقیت ثبت شد !</div>
                        </div>

                        <div>
                            <livewire:blog::comment-form :model="$model" />
                        </div>
                    @endauth
                    <!--end form-->
                </div>
            </div>
            @if ($comments->count() > 0)
                <div class="card shadow rounded border-0 mt-4">
                    <div class="p-3">
                        <h5 class="card-title mb-0">نظرات :</h5>

                        @error('content')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                        <ul class="media-list list-unstyled mb-0">
                            @foreach ($comments as $comment)
                                @if ($comment->is_visible)
                                    @livewire('comment-message', ['comment' => $comment, 'model' => $model])
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
