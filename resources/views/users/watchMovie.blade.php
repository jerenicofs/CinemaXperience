@extends('layouts.master')

@section('title', 'Watch Movie')

@section('css')
@endsection

@section('content')
<div class="flex flex-col min-h-screen" style="background-color: #262422;">
    <div class="flex-grow flex items-center justify-center mb-4 mt-4">
        <div class="w-full max-w-4xl bg-zinc-900 p-6 rounded-md shadow-lg mx-4 ">
            <iframe class="w-full rounded-md mb-4 aspect-video"
                src="https://www.youtube.com/embed/{{ $movie->source }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
            <a href="{{ route('detail.show', $movie->id) }}">
                <h1 class="text-white text-3xl font-bold mb-2 hover:underline">{{ $movie->title }}</h1>
            </a>
            <p class="text-white mb-2">{{ $movie->description }}</p>
            <p class="text-white mb-2">Rating: {{ $movie->rating }}/10</p>
            <p class="text-white mb-4">Release Date: {{ $movie->released_date }}</p>
            <p class="text-white mb-2">Genres: {{ $movie->genre->implode('genre_type', ', ') }}</p>
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="object-cover w-full h-64 rounded-md mb-4">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoElement = document.querySelector('video');
        videoElement.addEventListener('error', function(event) {
            console.error('Error playing video:', event);
            alert('Error playing video. Please check the console for more details.');
        });

        console.log('Video source:', '{{ $movie->source }}');
    });
</script>
@endsection
