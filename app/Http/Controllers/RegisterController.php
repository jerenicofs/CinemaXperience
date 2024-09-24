<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function regist(Request $request){
        $messages = [
            'first_name.required' => 'The first name is required.',
            'first_name.max' => 'The first name may not be greater than 135 characters.',
            'last_name.max' => 'The last name may not be greater than 120 characters.',
            'email.email' => 'The email must be a valid email address.',
            'email.required' => 'The email is required.',
            'dob.required' => 'The dob is required.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 5 characters.',
            'password.max' => 'The password may not be greater than 30 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'terms.accepted' => 'You must accept the Terms & Conditions.'
        ];

        $request->validate([
            'first_name' => 'required|max:135',
            'last_name' => 'max:120',
            'email' => 'email|required',
            'dob' => 'required',
            'password' => 'required|min:5|max:30|confirmed',
            'terms' => 'accepted'
        ], $messages);

        $name = $request->first_name . ' ' . $request->last_name;

        User::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->route('login')->with('success', 'Registration success!! Please proceed to login...');

    }

    public function showSignUpPage() {
        return view('registerPage');
    }
}
