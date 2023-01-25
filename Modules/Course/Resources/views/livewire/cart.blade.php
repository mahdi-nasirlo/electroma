<div>
    <div>
        <a href="{{ $link }}">
            <button wire:click='addToCart' class="btn btn-outline-primary rounded">
                <x-icon-o-shopping-cart />
                {!! $btnText !!}
                <div wire:loading style="width: 20px;height: 20px" class="spinner-border text-light" role="status">
            </button>
        </a>
    </div>
</div>
