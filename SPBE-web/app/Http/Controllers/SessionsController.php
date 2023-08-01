<?php

namespace App\Http\Controllers;

Use Str;
Use Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // $emails = request()->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $username = request()->username;

        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            auth()->attempt(['email' => $username, 'password' => request()->password]);
        } else {
            //they sent their username instead
            auth()->attempt(['nip' => $username, 'password' => request()->password]);
        }

        if ( auth()->check() ) {
            request()->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        //Nope, something wrong during authentication
        return redirect()->back()->withErrors([
            'username' => 'Please, check your credentials'
        ]);
    }

    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    }

    public function update(){

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/sign-in');
    }

}
