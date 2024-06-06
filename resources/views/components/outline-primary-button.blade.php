@if ($attributes['type'] == 'hyperlink')
    <a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-transparent border-2 rounded-sm font-semibold text-xs text-gray tracking-widest transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-transparent border-2 rounded-sm font-semibold text-xs text-gray tracking-widest transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endif