<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Display the login view.
     *
     * Returns the view for the login page with the title "Login".
     *
     * @return View The login page view.
     */
    public function create(): View
    {
        return view('auth.login')->with('title', 'Login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * Validates the email, ensures it exists in the users table, authenticates the user,
     * regenerates the session, and redirects to the dashboard with a success message.
     *
     * @param LoginRequest $request The validated login request.
     * @return RedirectResponse Redirects to the dashboard after successful login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('dashboard')->with('message', 'Berhasil Login');
    }

    /**
     * Destroy an authenticated session.
     *
     * Logs out the user, invalidates the session, regenerates the CSRF token,
     * and redirects to the homepage.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirects to the homepage after logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
