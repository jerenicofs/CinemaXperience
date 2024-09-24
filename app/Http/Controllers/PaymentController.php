<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function card(){
        return view('users.PaymentPageCard');
    }

    public function qris(){
        return view('users.PaymentPageQris');
    }
}
