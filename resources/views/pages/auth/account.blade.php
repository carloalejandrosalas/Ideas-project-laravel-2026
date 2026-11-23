<x-layout title="Account">
    <h3 class="text-md font-light mb-1 rounded">Account information</h3>
    @if (Session::has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4 mt-3">
            {{ Session::get('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('account.update') }}">
        @method('PUT')
        @csrf
        <x-text-input name="name" label="Name" value="{{ Auth::user()->name }}" required />
        <x-text-input name="email" label="Email" value="{{ Auth::user()->email }}" required />
        <x-button variant="primary" type="submit">Update</x-button>
    </form>

    <x-separator />

    <h4 class="text-md font-light mb-1 rounded my-6">Change Password</h4>
    @if (Session::has('password-update-message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4 mt-3">
            {{ Session::get('password-update-message') }}
        </div>
    @endif
    <form method="POST" action="{{ route('account.password.update') }}">
        @method('PUT')
        @csrf
        <x-text-input name="current_password" label="Current Password" type="password" required />
        <x-text-input name="password" label="New Password" type="password" required />
        <x-text-input name="password_confirmation" label="Confirm New Password" type="password" required />
        <x-button variant="primary" type="submit">Change Password</x-button>
    </form>


    <h4 class="text-md font-light mb-1 rounded my-6">Session Actions</h4>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-button variant="danger" type="submit">Logout</x-button>
    </form>
</x-layout>
