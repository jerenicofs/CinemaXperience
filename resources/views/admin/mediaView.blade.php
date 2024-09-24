@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('css')

@endsection

@section('content')

    <div class="mt-12 ml-8 text-4xl md:text-6xl font-bold typing-effect w-fit text-yellow-300">Lists of Media</div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8 mx-8">
        @foreach ($medias as $media)
        <div class="rounded-lg shadow-lg bg-gray-800 p-6">
            <img id="media-image" class="w-full max-w-full max-h-96 rounded-lg mb-4 object-cover" src="{{ asset('storage/' . $media->poster) }}" alt="Image">
            <div class="text-white">
                <h2 id="media-title" class="text-2xl md:text-3xl lg:text-4xl font-bold mb-2">{{ $media->title }}</h2>
                <p id="media-description" class="text-lg mb-2">{{ $media->description }}</p>
                <p id="media-rating" class="text-lg mb-2">Rating: {{ $media->rating }}</p>
                <p id="media-release" class="text-lg mb-2">Release Date: {{ $media->released_date }}</p>
                <p class="text-white mb-2">Genres: {{ $media->genre->implode('genre_type', ', ') }}</p>
                <div class="flex justify-between">
                    <a href="{{ route('medias.edit', $media->id) }}" class="flex justify-center w-1/3 items-center text-black bg-yellow-500 hover:bg-yellow-600 px-7 py-2 mt-6 mb-4 text-center rounded-full font-bold text-lg">Update</a>
                    <form action="{{ route('medias.destroy', $media->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex justify-center w-44 items-center text-black bg-yellow-500 hover:bg-yellow-600 px-7 py-2 mt-6 mb-4 text-center rounded-full font-bold text-lg">Delete</button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

@endsection
