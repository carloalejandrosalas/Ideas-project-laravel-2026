<x-layout title="Edit Idea" backRoute="ideas.show" :backRouteParams="[$idea->id]">
    <form action="{{ route('ideas.update', $idea) }}" method="POST">
        @csrf
        @method('PUT')
        <x-text-input label="Title" type="text" name="title" id="title" value="{{ $idea->title }}" required />
        <x-text-area label="Description" name="description" id="description" cols="30" rows="5"
            required>{{ $idea->description }}</x-text-area>
        <x-button variant="primary" type="submit">Update</x-button>
    </form>
</x-layout>
