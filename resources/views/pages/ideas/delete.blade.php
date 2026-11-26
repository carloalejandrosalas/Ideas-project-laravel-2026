<x-layout title="Delete Idea">
    <h6>Are you sure you want to delete <strong>"{{ $idea->title }}"</strong>?</h6>
    <form action="{{ route('ideas.destroy', $idea->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <x-button variant="danger" type="submit">Delete</x-button>
        <x-button variant="default" :to="route('home')">Cancel</x-button>
    </form>
</x-layout>
