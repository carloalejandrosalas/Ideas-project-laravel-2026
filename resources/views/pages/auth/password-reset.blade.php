<x-layout title="Reset Password">
    <form action="{{ route('request.password.link') }}" method="POST">
        @csrf
        <x-text-input label="Email" name="email" type="email" />
        <x-button variant="primary" type="submit">Send Reset Link</x-button>
    </form>
</x-layout>
