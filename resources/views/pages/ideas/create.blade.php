<x-layout title="Create Idea" backRoute="ideas.index">
    <form action="{{ route('ideas.store') }}" method="POST">
        @csrf
        <x-text-input label="Title" type="text" name="title" id="title" required />
        <x-text-area label="Description" name="description" id="description" required cols="30" rows="5" />
        <x-button variant="primary" type="submit">Save</x-button>
    </form>
</x-layout>
