@if ($product->comments()->where('is_visible', true)->count() > 0)
    @foreach ($product->comments as $comment)
        @if ($comment->is_visible)
            <li>
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <a class="pe-3" href="#">
                            @if ($comment->user->avatar)
                                <img src="{{ asset($comment->user->avatar ? '/storage/' . $comment->user->avatar : '/theme/images/Sample.png') }}"
                                    class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                            @else
                                <x-icon-o-user />
                            @endif
                        </a>
                        <div class="flex-1 commentor-detail">
                            <h6 class="mb-0">
                                <a href="javascript:void(0)" class="text-dark media-heading">
                                    {{ $comment->user->name }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->ago() }}
                            </small>
                        </div>
                    </div>
                    @if ($comment->rating)
                        <ul class="list-unstyled mb-0">
                            <ul class="list-unstyled text-warning h5 mb-0 d-flex p-0">
                                @for ($i = 0; $i < 5; $i++)
                                    <li class="list-inline-item">
                                        @if ($i > $comment->rating - 1)
                                            <x-font-star-o style="width: 15px;height: 15px;" />
                                        @else
                                            <x-font-star style="width: 15px;height: 15px;" />
                                        @endif
                                    </li>
                                @endfor
                            </ul>
                        </ul>
                    @endif
                </div>
                <div class="mt-3">
                    <p class="text-muted fst-italic p-3 bg-light rounded">"
                        {{ $comment->content }} "
                    </p>
                </div>
            </li>
        @endif
    @endforeach
@else
    <div class="d-flex justify-content-center flex-column">
        <img style="margin: 0 auto" class="w-25
            " src="/static/none-comment.png">
        <small class="text-center">دیدگاهی وجود ندارد.</small>
        <strong class="text-center font-bold">اولین نفری باشید که دیدگاه ثبت می کنید.</strong>
    </div>
@endif
