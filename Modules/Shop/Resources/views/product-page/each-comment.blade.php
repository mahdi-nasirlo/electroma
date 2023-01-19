@if ($product->comments()->where('is_visible', true)->count() > 0)
    @foreach ($product->comments as $comment)
        @if ($comment->is_visible)
            <li>
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <a class="pe-3" href="#">
                            <img src="{{ asset($comment->user->avatar ? '/storage/' . $comment->user->avatar : '/theme/images/Sample.png') }}"
                                class="img-fluid avatar avatar-md-sm rounded-circle shadow" alt="img">
                        </a>
                        <div class="flex-1 commentor-detail">
                            <h6 class="mb-0">
                                <a href="javascript:void(0)" class="text-dark media-heading">
                                    {{ $comment->user->name }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                {{ $comment->create_at }}
                                {{ \Morilog\Jalali\Jalalian::forge($comment->create_at)->ago() }}
                            </small>
                        </div>
                    </div>
                    @if ($comment->rating)
                        <ul class="list-unstyled mb-0">
                            @php
                                $i = 0;
                            @endphp
                            @while ($i < 4)
                                <li class="list-inline-item"><i
                                        class="mdi {{ $i < $comment->rating ? 'mdi-star' : 'mdi-star-outline' }} text-warning"></i>
                                </li>
                                @php
                                    $i = $i + 1;
                                @endphp
                            @endwhile

                            <li class="list-inline-item"><i class="mdi mdi-star-outline text-warning"></i></li>
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
