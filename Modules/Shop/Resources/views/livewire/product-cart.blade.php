<div style="cursor: pointer;" wire:click='addToCart'
     class="w-100 rounded-md text-center py-1 my-2 text-white {{ $has_inventory ? 'bg-warning' : 'bg-soft-warning' }}">
    افزودن به سبد خرید
    <div style="width: 25px; height: 25px" wire:loading class="spinner-grow btn-group" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <span class="d-none d-md-inline" wire:loading.remove>
        <x-icon-s-shopping-cart/>
    </span>
</div>
