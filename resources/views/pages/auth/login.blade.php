<x-layout title="Login">
    @if (Session::has('error'))
        <x-alert variant="error">
            {{ Session::get('error') }}
        </x-alert>
    @endif
    @if (Session::has('success'))
        <x-alert variant="success">
            {{ Session::get('success') }}
        </x-alert>
    @endif
    @if (Session::has('info'))
        <x-alert variant="info">
            {{ Session::get('info') }}
        </x-alert>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <x-text-input label="Email" name="email" type="email" />
        <x-text-input label="Password" name="password" type="password" />
        <x-button variant="link" type="button" onclick="window.location='{{ route('request.reset') }}'">Forgot
            the password?</x-button>
        <br>
        <x-button variant="primary" type="submit">Login</x-button>
    </form>
</x-layout>
