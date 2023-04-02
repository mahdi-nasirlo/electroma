<div class="relative flex items-center justify-center text-center">
    <div class="absolute border-t border-gray-200 w-full h-px"></div>
    <p
        class="inline-block relative bg-white text-sm p-2 rounded-full font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-100">
        یا با حساب کاربری خود وارد شوید
    </p>
</div>

<div class="grid grid-cols-1 gap-4">
    <x-filament::button color="secondary" icon="font-google" tag="a" :href="route('auth.google')">
        {{-- {{ $provider['label'] }} --}}
        google
    </x-filament::button>
</div>
