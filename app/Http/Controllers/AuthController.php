<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Providers\AppServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login():View
    {
        return view('Auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(UserLoginRequest $request)
    {
        // dd($request);
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(AppServiceProvider::HOME)->with('status', 'Berhasil login');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
