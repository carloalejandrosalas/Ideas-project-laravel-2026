@props(['variant' => 'default'])

@php
    $commonClasses = 'rounded p-4 mb-4 rounded';

    switch ($variant) {
        case 'success':
            $commonClasses .= ' bg-green-100 text-green-700';
            break;
        case 'error':
            $commonClasses .= ' bg-red-100 text-red-700';
            break;
        case 'warning':
            $commonClasses .= ' bg-yellow-100 text-yellow-700';
            break;
        default:
            $commonClasses .= ' bg-gray-100 text-blue-700';
            break;
    }
@endphp

<div class="{{ $commonClasses }}">
    {{ $slot }}
</div>
