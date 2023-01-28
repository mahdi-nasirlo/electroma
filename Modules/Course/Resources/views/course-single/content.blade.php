<div class="container-lg my-4">
    <div class="row justify-content-center">
        <div style="padding-bottom: 16px !important" class="card bg-light rounded shadow border-0 py-2">
            <div class="card-body py-3">
                <div class="mt-2 content bg-white p-3 rounded-2">
                    {!! $course->desc !!}
                </div>
            </div>

            <h6>


                @foreach ($course->tags as $item)
                    @if ($loop->first)
                        <x-font-tag style="color: rgb(255, 135, 23)" class="mdi mdi-tag me-1" />
                    @endif
                    <a href="javscript:void(0)" class="text-primary px-2">
                        {{ $item->name }}
                    </a>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </h6>
        </div>
    </div>
</div>
