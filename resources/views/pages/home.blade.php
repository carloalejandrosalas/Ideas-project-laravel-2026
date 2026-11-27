<x-layout showContainer="{{ false }}" title="List of Ideas" addRoute="ideas.create">
    <x-alert>Here is another one</x-alert>

    @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ Session::get('success') }}
        </div>
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
