@props(['variant' => 'default'])

@php
    $commonClasses = 'mt-2 px-4 py-2 text-black text-md rounded-md cursor-pointer inline-flex items-center';

    switch ($variant) {
        case 'success':
            $commonClasses .= ' bg-green-600 hover:bg-green-700';
            break;
        case 'danger':
            $commonClasses .= ' bg-red-600 text-white hover:bg-red-700';
            break;
        case 'primary':
            $commonClasses .= ' bg-blue-600 text-white hover:bg-blue-700';
            break;
        case 'link':
            $commonClasses =
                'mt-2 px-0 py-0 text-blue-600 underline text-md rounded-md cursor-pointer inline-flex items-center';
            break;
        default:
            $commonClasses .= ' bg-gray-200 hover:bg-gray-300';
            break;
    }

@endphp

@if ($attributes->get('to'))
    <a href="{{ $attributes->get('to') }}" {{ $attributes->merge(['class' => $commonClasses . '  px-4 py-2']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $commonClasses]) }}>
        {{ $slot }}
    </button>
@endif
