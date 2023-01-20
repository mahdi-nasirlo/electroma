       <form wire:submit.prevent='saveInfo'>
           <div class="row">
               <div class="col-md-6">
                   <div class="mb-3">
                       <label class="form-label">نام اصلی </label>
                       <div class="form-icon position-relative">
                           <i data-feather="user" class="fea icon-sm icons"></i>
                           <input wire:model="name" name="name" id="first-name" type="text"
                               class="form-control ps-5">
                           @if ($errors->has('name'))
                               <span class="text-danger">{{ $errors->first('name') }}</span>
                           @endif
                       </div>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <label class="form-label">ایمیل شما </label>
                       <div class="form-icon position-relative">
                           <i data-feather="mail" class="fea icon-sm icons"></i>
                           <input wire:model="email" name="email" id="email" type="email"
                               class="form-control ps-5">
                           @if ($errors->has('email'))
                               <span class="text-danger">{{ $errors->first('email') }}</span>
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

               <div class="col-lg-12 mt-2 mb-0">
                   <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
               </div>
               <!--end col-->
           </div>
           <!--end row-->
       </form>

       <div>
           <h5 class="mt-4">تغییر رمز عبور : </h5>
           <livewire:payment::profile.profile-password>
       </div>
