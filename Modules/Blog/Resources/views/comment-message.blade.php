<div>
    <li class="mt-4">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <a class="pe-3" href="#">
                    @if ($comment->user->avatar)
                        <img class="w-10 h-10 p-1 rounded" data-src="{{ $comment->user->avatar }}" alt="Bordered avatar">
                    @else
                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded dark:bg-gray-600">
                            <svg style="width: 20px;color: rgb(255, 115, 0)" class="" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </div>
                    @endif

                </a>
                <div class="commentor-detail">
                    <h6 class="mb-0"><a href="javascript:void(0)" class="text-dark media-heading">
                            {{ $comment->user->name }}
                        </a>
                    </h6>
                    <small class="text-muted">
                        {{ \Morilog\Jalali\Jalalian::forge($comment->created_at)->format('%A, %d %B %Y') }}
                    </small>
                </div>
            </div>
            {{-- <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#commentModal"
                    class="text-muted"><i class="mdi mdi-reply commentModalBtn"
                        answer="{{ $comment->user->name }}"></i> پاسخ </a> --}}
            @auth
                {{-- <button data-bs-toggle="modal" data-bs-target="#commentModal"
                        class="commentModalBtn py-0 btn px-1 rounded-md border border-1 border-white text-gray-500 font-semibold hover:rounded-md hover:text-blue-800 hover:border-orange-500"
                        replay_name="{{ $comment->user->name }}" parent_id='{{ $comment->id }}'>
                        پاسخ
                    </button> --}}
                <button style="height: 28px; line-height: 12px bg-warning" data-bs-toggle="modal"
                    data-bs-target="#commentModal" type="button" replay_name="{{ $comment->user->name }}"
                    parent_id='{{ $comment->id }}' class="commentModalBtn btn btn-sm btn-outline-warning">پاسخ</button>
            @endauth
            <!-- Modal Content Start -->
            <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="commentModal-title"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded shadow border-0">
                        <div class="modal-header border-bottom">
                            <h5 class="modal-title" id="commentModal-title"> ثبت پاسخ به {{ $comment->user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                        </div>
                        <div class="modal-body">
                            <livewire:blog::comment-form :model="$model" :replay="$comment" />
                            {{-- @livewire('comment-form', ['model' => $model, 'replay' => $comment], key($model->id)) --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Content End -->
        </div>
        <div class="mt-3">
            <p class="text-muted fst-italic p-3 bg-light rounded">
                " {{ $comment->content }} "
            </p>
        </div>

        @if ($comment->child()->count() > 0)
            <ul class="list-unstyled ps-4 ps-md-5 sub-comment">
                @foreach ($comment->child as $answer)
                    @include('blog::comment-message', ['comment' => $answer, 'model' => $model])
                @endforeach
            </ul>
        @endif
    </li>
</div>
