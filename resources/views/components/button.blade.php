@props([
    'type' => $type ?? 'button',
    'wireTarget' => null,
])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
        'inline-flex items-center justify-center w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center
         text-white bg-assu hover:bg-assu-700 focus:ring-4 focus:outline-none focus:ring-primary-300
         dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:opacity-70 cursor-pointer'
    ]) }}
    wire:loading.attr="disabled"
>
    <svg
        wire:loading
        @if($wireTarget) wire:target="{{ $wireTarget }}" @endif
        class="animate-spin h-5 w-5 mr-2 text-white"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
              d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>

    <span
        @if($wireTarget) wire:loading.remove wire:target="{{ $wireTarget }}" @else wire:loading.remove @endif>
        {{ $slot }}
    </span>
</button>
