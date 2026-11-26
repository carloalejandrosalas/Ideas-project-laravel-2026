<x-layout title="Set New Password">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <x-text-input name="password" label="New Password" type="password" required />
        <x-text-input name="password_confirmation" label="Confirm New Password" type="password" required />
        <x-button variant="primary" type="submit">Update Password</x-button>
    </form>
</x-layout>
