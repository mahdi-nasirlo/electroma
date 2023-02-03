<div>
    <form wire:submit.prevent='saveData'>
        <p id="error-msg" class="mb-0"></p>
        <div id="simple-msg"></div>
        <div class="row">
            <div class="col-md-6">
                <div style="display: block" class="mb-3 input-group has-validation">
                    <label class="form-label">نام شما <span class="text-danger">*</span></label>
                    <div class="form-icon position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-user fea icon-sm icons">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input aria-describedby="validationServerUsernameFeedback" value="{{ old('name') }}"
                            wire:model="name" id="name" type="text"
                            class="form-control ps-5 @error('name') is-invalid @enderror" placeholder="نام :">
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div style="display: block" class="mb-3 input-group has-validation">
                    <label class="form-label">موبایل شما <span class="text-danger">*</span></label>
                    <div class="form-icon position-relative">
                        <i class="uil uil-mobile-vibrate feather feather-mail fea icon-sm icons"></i>
                        <input wire:model="mobile" value="{{ old('mobile') }}" name="mobile" id="email"
                            type="text" class="form-control ps-5 @error('mobile') is-invalid @enderror"
                            aria-describedby="validationServerUsernameFeedbackmobiel" placeholder="موبایل :">
                        @if ($errors->has('mobile'))
                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-12">
                <div class="mb-3 input-group has-validation">
                    <label class="form-label">موضوع <span class="text-danger">*</span></label>
                    <div class="form-icon position-relative w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-book fea icon-sm icons">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z">
                            </path>
                        </svg>
                        <select wire:model="topic" name="item_id" id="subject"
                            aria-describedby="validationServerUsernameFeedbackitem"
                            class="form-control w-100 ps-5 @error('topic') is-invalid @enderror">
                            <option value="">موضوع :</option>
                            @foreach (\Modules\Service\Entities\ServiceItem::all() as $item)
                                <option {{ old('item_id' == $item->id ? 'selected' : '') }} value="{{ $item->id }}">
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('topic'))
                            <span class="text-danger">{{ $errors->first('topic') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-12">
                <div class="mb-3 input-group has-validation">
                    <label class="form-label">توضیحات</label>
                    <div class="form-icon position-relative w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-message-circle fea icon-sm icons clearfix">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                            </path>
                        </svg>
                        <textarea wire:model="desc" aria-describedby="validationServerUsernameFeedbackmessage" name="desc" id="comments"
                            rows="4" class="form-control ps-5 @error('desc') is-invalid @enderror" placeholder="پیام :">{{ old('desc') }}</textarea>
                        @if ($errors->has('desc'))
                            <span class="text-danger">{{ $errors->first('desc') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" id="submit" name="send" class="btn btn-primary">
                        <span wire:loading.remove> ارسال </span>
                        <span wire:loading> در حال پردازش </span>
                    </button>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </form>
    @if (session()->has('message'))
        <div style="margin-top: 10px" class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
