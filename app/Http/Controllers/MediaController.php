<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.media');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mediaAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rating' => 'required',
            'source' => 'required',
            'genre.*' => 'required|string|in:korean-drama,action,melodrama,romantic-comedy,thriller',
        ]);

        $path = null;
        if ($request->hasFile('poster')) {
            $uploadedFile = $request->file('poster');
            if ($uploadedFile && $uploadedFile->isValid()) {
                $path = $uploadedFile->store('posts_images', 'public');
            }
        }


        $premi = false;
        if($request->isPremium === 'premium'){
            $premi = true;
        }
        else{
            $premi = false;
        }

        $newMedia = Media::create([
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->rating,
            'poster' => $path,
            'isPremium' => $premi,
            'released_date' => $request->releaseDate,
            'source' => $request->source,
            'season' => $request->season ?? null,
            'duration' => $request->duration ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $genreTypes = is_array($request->genre) ? $request->genre : [$request->genre];
        $genres = Genre::whereIn('genre_type', $genreTypes)->get();
        $newMedia->genre()->attach($genres);



        return redirect()->route('medias.index')->with('success', 'Registration success!! Please proceed to login...');
    }

    public function view(){

        $medias = Media::all();
        return view('admin.mediaView', compact('medias'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::findOrFail($id);
        return view('admin.mediaUpdate', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rating' => 'required',
            'source' => 'required',
            'genre.*' => 'required|string|in:korean-drama,action,melodrama,romantic-comedy,thriller',
        ]);

        $media = Media::findOrFail($id);

        $path = $media->poster;
        if ($request->hasFile('poster')) {
            $uploadedFile = $request->file('poster');
            if ($uploadedFile && $uploadedFile->isValid()) {
                if ($media->poster) {
                    Storage::disk('public')->delete($media->poster);
                }
                $path = $uploadedFile->store('posts_images', 'public');
            }
        }

        $premi = false;
        if($request->isPremium === 'premium'){
            $premi = true;
        }
        else{
            $premi = false;
        }

        $media->update([
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->rating,
            'poster' => $path,
            'isPremium' => $premi,
            'released_date' => $request->releaseDate,
            'source' => $request->source,
            'season' => $request->season ?? null,
            'duration' => $request->duration ?? null,
            'updated_at' => Carbon::now(),
        ]);

        $genreTypes = is_array($request->genre) ? $request->genre : [$request->genre];
        $genres = Genre::whereIn('genre_type', $genreTypes)->get();
        $media->genre()->sync($genres);

        return redirect()->route('medias.index')->with('success', 'Media updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $media = Media::findOrFail($id);
        $media->delete();

        return Redirect::route('medias.index')->with('success', 'Media deleted successfully');
    }
}
