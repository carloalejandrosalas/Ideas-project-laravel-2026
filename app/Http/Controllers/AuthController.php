<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle a logout request.
     * POST /logout
     */
    public function logout()
    {
        Auth::logout();

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
}
