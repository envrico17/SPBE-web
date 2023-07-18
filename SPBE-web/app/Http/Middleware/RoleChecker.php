<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        if (!Auth::check())
            return redirect()->route('login');

        $user = Auth::user();

        if($user->hasRole('admin')) {
            return $next($request);
        }

        foreach ($roles as $role) {
            if($user->hasRole($role)) {
                return $next($request);
            }
            else
                $request->session()->flash('error','Anda tidak punya akses!');
                return redirect()->back();
        }
    }
}
