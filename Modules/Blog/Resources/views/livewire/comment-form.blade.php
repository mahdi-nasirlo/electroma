<div>
    <div>
        <form class="mt-3" wire:submit.prevent='saveComment'>

            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">نظر شما</label>
                        <div class="form-icon position-relative">
                            <x-font-comment-o data-feather="message-circle" class="icon-sm icons" />
                            <textarea wire:model="message" id="message" placeholder="کامنت شما" rows="5" name="content"
                                class="form-control ps-5 border border-slate-300 rounded focus:border-orange-400"></textarea>
                            @error('message')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @if (session()->has('message'))
                                <div style="margin-top: 10px" class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--end col-->

                {{-- <input type="hidden" name="commentable_id" value="{{ $model->id }}"> --}}
                {{-- <input type="hidden" name="commentable_type" value="{{ get_class($model) }}"> --}}
                {{-- <input type="hidden" name="parent_id" value="0"> --}}

                <div class="col-md-12">
                    <div class="send d-grid">
                        <button id="send_comments" type="submit" class="btn btn-primary">
                            <span wire:loading.remove> ارسال پیام </span>
                            <span wire:loading> در حال پردازش </span>
                        </button>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </form>
    </div>
</div>
