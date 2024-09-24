<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function handle()
    {
        if (auth()->check()) {
            if(Auth::user()->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }
            else{

                return redirect()->route('user.home');
            }
        }

        return redirect('/login');
    }

    public function showLandingPage(){
        return view('landingPage');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();

            if(Auth::user()->role === 'admin'){
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.home');
            }
        };

        return back()->with('loginError', 'Invalid login attempt!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
