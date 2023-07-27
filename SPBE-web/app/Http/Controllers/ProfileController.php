<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('sessions.password.reset', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {

        $user = auth()->user();
        $request->validate([
            // 'email' => 'required|email|unique:users,email,'.$user->id,
            // 'name' => 'required',
            // 'phone' => 'nullable',
            // 'pangkat' => 'nullable',
            // 'phone' => 'nullable',
            'password' => 'required|min:8|confirmed',
        ]);

        // Debug the new password before hashing
        // dump('New Password Before Hashing: ' . $request->password);

        $user->update([
            'password' => $request->password,
        ]);

        // Debug the new password after hashing
        // dd('New Password After Hashing: ' . $user->password);

        return redirect()->route('dashboard')
        ->with('success','Password berhasil diupdate');
    }
}
