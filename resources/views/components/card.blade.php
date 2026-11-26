@props([
    'title' => '',
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-slate-200 bg-white p-6 shadow-sm']) }}>
    <h3 class="text-lg font-bold text-slate-900 mb-4">{{ $title }}</h3>
    <div>
        {{ $slot }}
    </div>
</div>
