<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaDetailsController extends Controller
{
    public function showDetails($id){

        $media = Media::findOrFail($id);

        return view('users.mediaDetails', compact('media'));
    }
}
