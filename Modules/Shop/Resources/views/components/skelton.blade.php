<div>
    <div>
        @php
            $count = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        @endphp

        <div class="row">
            @foreach ($count as $item)
                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-4">
                    <div class="card shop-list border-0 position-relative">
                        <div class="skeleton-loader img-cover">
                        </div>
                        <div class="skeleton-loader mt-3">
                        </div>
                        <div class="skeleton-loader mt-2">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
