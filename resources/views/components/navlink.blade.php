@props([
    'title' => '',
    'variant' => 'default',
])
@php
    $commonClasses =
        'inline-flex rounded-lg px-3 py-2 text-sm font-medium text-slate-700 transition-all duration-200 hover:bg-slate-100 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';

    switch ($variant) {
        case 'primary':
            $commonClasses .= ' text-white bg-blue-600 hover:bg-blue-700';
            break;
        case 'secondary':
            $commonClasses .= ' text-gray-700 bg-gray-100 hover:bg-gray-200';
            break;
        default:
            // default variant already has the base classes
            break;
    }

@endphp

<li>
    <a {{ $attributes->merge(['title' => $title ?? '', 'class' => $commonClasses]) }}>
        {{ $slot }}
    </a>
</li>
