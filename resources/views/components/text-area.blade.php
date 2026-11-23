<div class="mb-4">
    <div class="flex flex-col">
        <label class="mb-1"
            for="{{ $attributes->get('id') }}">{{ $attributes->get('label') ?? ucfirst($attributes->get('name')) }}
            @if ($attributes->get('required'))
                <span class="text-red-500">*</span>
            @endif
        </label>
        <textarea {{ $attributes->merge(['class' => 'bg-gray-100 border border-gray-300 rounded p-2 rounded-lg']) }}>{{ $slot }}</textarea>
    </div>
</div>
