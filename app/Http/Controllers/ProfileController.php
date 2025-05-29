<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the form for changing the user password.
     *
     * Returns the view to change the password with the title "Ganti Password User".
     *
     * @return View The view to change the user password.
     */
    public function changePassword(): View
    {
        return view('change-password')->with('title', 'Ganti Password User');
    }

    /**
     * Process the change of user password.
     *
     * Validates the new password and updates it in the database.
     * Redirects to the dashboard page with a success message.
     *
     * @param ChangePasswordRequest $request The request containing the new password.
     * @return RedirectResponse Redirects to the dashboard page with a success message.
     */
    public function prosesChangePassword(ChangePasswordRequest $request): RedirectResponse
    {
        $user = User::find(Auth::id());

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return to_route('dashboard')->with('message', 'Berhasil Mengganti Password User');
    }
}
