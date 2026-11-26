<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    /**
     * Handle an authentication attempt.
     * POST /login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('ideas.index');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Handle a logout request.
     * POST /logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    /**
     * Show the login form.
     * GET /login
     */
    public function showLogin()
    {
        return view('pages.auth.login');
    }

    /**
     * Show the registration form.
     * GET /register
     */
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    /**
     * Show the account information form.
     * GET /account
     */
    public function showAccount()
    {
        return view('pages.auth.account');
    }

    /**
     * Handle a registration request.
     * POST /register
     */
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);

        // Store user data in session
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);

        return redirect()->route('ideas.index');
    }

    public function updateAuthenticatedUser(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Update session data
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);

        Session::flash('success', 'Information updated successfully.');

        return redirect()->route('account');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        $credentials = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);

        $isValid = Hash::check($credentials['current_password'], $user->password);

        if (! $isValid) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $user->password = bcrypt($credentials['password']);

        $user->save();

        Session::flash('password-update-message', 'Password updated successfully.');

        return redirect()->route('account');
    }

    public function showPasswordReset()
    {
        return view('pages.auth.password-reset');
    }

    public function sendPasswordResetLink(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        $email = $data['email'];

        $existingToken = PasswordResetToken::where('email', $email)->first();

        if ($existingToken && $existingToken->expires_at > now()) {
            Session::flash('info', 'An existing password reset token is still valid (24 hours alive). Please check your inbox.');

            return redirect()->route('login');
        }

        // Generate a password reset token
        $token = Str::random(60);

        // Send password reset email
        PasswordResetToken::create([
            'email' => $email,
            'token' => $token,
            'expires_at' => now()->addHours(24),
        ]);

        // TODO allow sending password reset email in production environment only.
        // Mail::to($email)->send(new PasswordResetMail($token));

        Session::flash('success', 'Password reset link generated successfully.');

        return redirect()->route('login');
    }

    public function showNewPasswordForm(Request $request, $token)
    {
        Session::put('password_reset_token', $token);

        return view('pages.auth.new-password', ['token' => $token]);
    }

    public function newPassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);

        $token = Session::get('password_reset_token');

        $passwordReset = PasswordResetToken::where('token', $token)->first();
        $invalidOrExpiredMessage = 'The password reset token is invalid or has expired.';

        if (! $passwordReset) {
            return redirect()->route('login')->withErrors([
                'email' => $invalidOrExpiredMessage,
            ]);
        }

        $isExpired = $passwordReset->expires_at < now();

        if ($isExpired) {
            return redirect()->route('login')->withErrors([
                'email' => $invalidOrExpiredMessage,
            ]);
        }

        $user = User::where('email', $passwordReset->email)->first();

        // Just in case the user no longer exists, handle it gracefully.
        if (! $user) {
            return back()->withErrors([
                'error' => 'User not found.',
            ]);
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        // Delete the used token
        $passwordReset->delete();

        // Cleared the password reset token from the session.
        Session::forget('password_reset_token');

        // Flash a success message to the session.
        Session::flash('success', 'Password updated successfully.');

        return redirect()->route('login');
    }
}
