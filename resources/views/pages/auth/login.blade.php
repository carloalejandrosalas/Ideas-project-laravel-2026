<x-layout title="Login">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <x-text-input label="Email" name="email" type="email" />
        <x-text-input label="Password" name="password" type="password" />
        <x-button variant="primary" type="submit">Login</x-button>
    </form>
</x-layout>
