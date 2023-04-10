@if ($related->count() > 0)
    <div class="card shadow rounded border-0 mt-3">
        <div class="card-body py-1 pt-2">
            <h5 class="card-title mb-3">پست های مرتبط :</h5>

            <div class="row">
                @foreach ($related as $item)
                    @include('blog::post-cart', [
                        'post' => $item,
                        'class' => 'col-12 col-md-6 mb-4 pb-2 test',
                    ])
                @endforeach
            </div>
        </div>
    </div>
@endif
