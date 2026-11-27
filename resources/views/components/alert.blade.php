@props(['variant' => 'default'])

@php
    $commonClasses = 'rounded p-4 mb-4 rounded flex justify-between items-center';
    $commonCloseButtonClasses = 'ml-auto p-0 mt-0 mx-0 text-blue-700';

    switch ($variant) {
        case 'success':
            $commonClasses .= ' bg-green-100 text-green-700';
            $commonCloseButtonClasses .= ' text-green-700';
            break;
        case 'error':
            $commonClasses .= ' bg-red-100 text-red-700';
            $commonCloseButtonClasses .= ' text-red-700';
            break;
        case 'warning':
            $commonClasses .= ' bg-yellow-100 text-yellow-700';
            $commonCloseButtonClasses .= ' text-yellow-700';
            break;
        default:
            $commonClasses .= ' bg-gray-100 text-blue-700';
            $commonCloseButtonClasses .= ' text-blue-700';
            break;
    }
@endphp

<div class="{{ $commonClasses }}">
    <span>
        {{ $slot }}
    </span>
    <x-button variant="transparent" type="button" class="{{ $commonCloseButtonClasses }}"
        data-action="hide-alert">×</x-button>
</div>
