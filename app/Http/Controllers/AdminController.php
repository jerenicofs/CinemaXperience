<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdminDashboard(){
        $users = User::count();
        $movies = Media::count();

        return view('admin.adminDashboard', compact('users', 'movies'));

    }

}
