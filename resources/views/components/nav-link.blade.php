@props(['title', 'active'])

@php
    $classes = ($active ?? false)
                ? 'bg-amber-900 text-white block rounded-md px-3 py-2 text-base font-medium transition ease'
                : 'hover:bg-amber-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium transition ease';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $title }}
</a>
