@if (filled($brand = config('filament.brand')))
    <div class="flex ">
        {{-- <div @class([
            'filament-brand text-xl font-bold tracking-tight',
            'dark:text-white' => config('filament.dark_mode'),
        ])>
            {{ $brand }}
        </div> --}}
        <img src="/static/logo.png" alt="Logo" class="h-10 mx-5">
    </div>
@endif
