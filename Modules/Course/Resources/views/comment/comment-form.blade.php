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
                          <x-icon-o-arrow-sm-left />
                      </div>
                  </div>
              @endguest
              @auth
                  <div id="successMs" style="display: none" class="md:flex rounded text-white bg-green-400 p-2 mt-3">
                      <div class=" w-full font-semibold">دیدگاه شما با موفقیت ثبت شد !</div>
                  </div>
                  <form class="mt-3" method="POST" action="">

                      @csrf

                      <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label class="form-label">نظر شما</label>
                                  <div class="form-icon position-relative">
                                      <x-font-comment-o data-feather="message-circle" class="icon-sm icons" />
                                      <textarea id="message" placeholder="کامنت شما" rows="5" name="content"
                                          class="form-control ps-5 border border-slate-300 rounded focus:border-orange-400" required=""></textarea>
                                  </div>
                              </div>
                          </div>
                          <!--end col-->

                          <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
                          <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
                          <input type="hidden" name="parent_id" value="0">

                          <div class="col-md-12">
                              <div class="send d-grid">
                                  <button id="send_comments" type="submit" class="btn btn-primary">ارسال پیام</button>
                              </div>
                          </div>
                          <!--end col-->
                      </div>
                      <!--end row-->
                  </form>
              @endauth
              <!--end form-->
          </div>
      </div>
