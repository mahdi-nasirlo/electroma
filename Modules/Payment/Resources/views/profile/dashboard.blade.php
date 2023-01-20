   <div class="tab-pane fade bg-white {{ activeClassProfile('dashboard') }} shadow rounded p-4" id="dash"
       role="tabpanel" aria-labelledby="dashboard">
       <h6 class="text-muted">سلام <span class="text-dark">{{ auth()->user()->name }}</span> (نیستید <span
               class="text-dark">{{ auth()->user()->name }}</span>? <a href="javascript:void(0)"
               class="text-danger">خروج</a>)</h6>

       <h6 class="text-muted mb-0">از داشبورد حساب خود می توانید خود را مشاهده کنید <a href="javascript:void(0)"
               class="text-danger">سفارشات اخیر</a>, با مدیریت شما <a href="javascript:void(0)" class="text-danger">آدرس
               حمل و نقل و صورتحساب</a>, و <a href="javascript:void(0)" class="text-danger">رمز ورود و جزئیات حساب خود
               را ویرایش
               کنید</a>.</h6>
   </div>
   <!--end teb pane-->
