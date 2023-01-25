<div>
    <div class="subcribe-form w-100">
        <form class="">
            <input wire:model='string' class="form-control rounded-md shadow py-2 search-input" placeholder="جستو جو ...."
                required="" aria-describedby="newssubscribebtn">
            <button style=" padding: 6px 7px;" type="submit" class="btn btn-primary d-flex align-item-center">
                <div style="width: 25px; height: 25px" wire:loading class="spinner-grow" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <x-icon-s-search style="width: 26px" wire:loading.remove />
            </button>
            @if ($string)
                <div style="position: absolute;z-index: 10;"
                    class="shadow-lg bg-white rounden-md w-100 mt-2 search-result">
                    @foreach ($result as $item)
                        <div class="px-2 py-3 bg-white text-primary d-flex align-items-center">
                            <a href="{{ route('shop.product.single', $item) }}">
                                <img src="{{ $item->getCoverUrl() }}"
                                    class="img-fluid avatar avatar-small rounded shadow" style="height:auto;"
                                    alt="">
                            </a>
                            <span class="d-flex ms-1">
                                <a href="{{ route('shop.product.single', $item) }}">
                                    {{ $item->name }}
                                </a>
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </form>
    </div>
    <style>
        .search-result {
            display: none;
            max-height: 300px;
            overflow-y: scroll;
        }

        .search-result:hover {
            display: block;
        }

        .search-input:focus~.search-result {
            display: block !important;
        }
    </style>
</div>



{{-- 
 Tood
    
    --}}
