<x-layout title="Home">
    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <p class="mb-4">
        Welcome to our website!
    </p>
</x-layout>
