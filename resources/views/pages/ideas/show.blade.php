<x-layout title="View Idea" backRoute="ideas.index">
    <div class="max-w-7xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">{{ $idea->title }}</h1>
        <p class="mb-4">{{ $idea->description }}</p>
        <p class="text-sm text-gray-500 mb-5">Created at: {{ $idea->created_at->format('m/d/Y H:i') }}</p>
        <x-button to="{{ route('ideas.edit', $idea->id) }}" class="text-sm">Edit</x-button>
    </div>
</x-layout>
