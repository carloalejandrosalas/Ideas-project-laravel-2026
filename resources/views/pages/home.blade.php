<x-layout showContainer="{{ false }}" title="List of Ideas" addRoute="ideas.create">
    @if (Session::has('success'))
        <x-alert variant="success">
            {{ Session::get('success') }}
        </x-alert>
    @endif
    @if (Session::has('error'))
        <x-alert variant="error">
            {{ Session::get('error') }}
        </x-alert>
    @endif

    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-3 gap-3">
        @foreach ($ideas as $idea)
            <x-card onclick="window.location='{{ route('ideas.show', $idea->id) }}'" title="{{ $idea->title }}"
                class="cursor-pointer">
                {{ $idea->description }}
            </x-card>
        @endforeach
    </div>
    @if ($ideas->isEmpty())
        <p class="col-span-3 text-center text-gray-500">No ideas created yet. Please create one to see it here 😊</p>
    @endif
</x-layout>
