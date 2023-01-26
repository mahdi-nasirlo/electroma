<div class="modal-content rounded shadow border-0">
    <div class="modal-header border-bottom">
        <h5 class="modal-title" id="commentModal-title">ثبت پاسخ به </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-icon position-relative">
                    @if (session()->has('message'))
                        <div class="alert alert-success mt-2" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <x-font-comment-o class="fea icon-sm icons" data-feather="message-circle" />
                    <textarea wire:model='comment' id="message" placeholder="کامنت شما" rows="5" name="content"
                        class="form-control ps-5 border border-slate-300 rounded focus:border-orange-400" required=""></textarea>
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button wire:click='submitComment' id="send_replay_comments" class="btn btn-primary">ارسال
            دیدگاه</button>
    </div>
</div>
