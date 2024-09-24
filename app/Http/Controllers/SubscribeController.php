<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function show()
    {
        return view('users.subscriptionPage');
    }
}
