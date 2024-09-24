<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $medias = Media::all();
        return view('users.homePage', compact('medias'));
    }
}
