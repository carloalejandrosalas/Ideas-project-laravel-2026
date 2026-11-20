<x-layout title="Create Idea">
    <form action="{{ route('ideas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="" name="title" id="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Idea</button>
    </form>
</x-layout>
