<x-layout title="Register">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-text-input name="name" label="Name" />
        <div>
            <x-text-input name="email" label="Email" type="email" />
            <x-text-input name="password" label="Password" type="password" />
            <x-button variant="primary" type="submit">Register</x-button>
    </form>
</x-layout>
