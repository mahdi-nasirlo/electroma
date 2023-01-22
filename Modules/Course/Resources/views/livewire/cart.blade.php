<div>
    <div>
        <a href="{{ $link }}">
            <button wire:click='addToCart' class="btn btn-outline-primary rounded">
                <i class="uil uil-store"></i>
                {!! $btnText !!}
                <div wire:loading style="width: 20px;height: 20px" class="spinner-border text-white" role="status">
            </button>
        </a>
    </div>
</div>
