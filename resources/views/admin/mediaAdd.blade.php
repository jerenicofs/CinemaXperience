@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
<style>

    input[type="date"]::-webkit-calendar-picker-indicator {
      filter: invert(1);
    }
  </style>
@endsection

@section('content')

<div class="mt-12 ml-8 text-4xl md:text-6xl font-bold typing-effect w-fit text-yellow-300">Add New Media</div>



@if ($errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger w-1/2 ml-16 mt-8">{{ $error }}</div>
@endforeach
@endif

<div class="container mx-auto px-4 py-8 shadow-lg rounded-lg my-8 bg-gray-800">
  <div class="flex flex-col space-y-4">

    <form class="flex flex-col space-y-6" method="POST" action="{{ route('medias.store') }}" enctype="multipart/form-data">
        @csrf
      <div class="flex items-center space-x-2">
        <label for="title" class="w-1/4 font-bold text-xl text-yellow-500">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="description" class="w-1/4 font-bold text-xl text-yellow-500">Description:</label>
        <textarea id="description" name="description" rows="4" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">{{ old('description') }}</textarea>
      </div>

      <div class="flex items-center space-x-2">
        <label for="genre" class="w-1/4 font-bold text-xl text-yellow-500">Genre:</label>
        <select id="genre" name="genre[]" multiple class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
            <option value="korean-drama">Korean Drama</option>
            <option value="action">Action</option>
            <option value="melodrama">Melodrama</option>
            <option value="romantic-comedy">Romantic Comedy</option>
            <option value="thriller">Thriller</option>
        </select>
      </div>

      <div class="flex items-center space-x-2">
        <label for="rating" class="w-1/4 font-bold text-xl text-yellow-500">Rating:</label>
        <input type="number" min="0" max="10" step="0.1" id="rating" name="rating"  value="{{ old('rating') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="poster" class="w-1/4 font-bold text-xl text-yellow-500">Poster:</label>
        <input type="file" id="poster" name="poster" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="isPremium" class="w-1/4 font-bold text-xl text-yellow-500">isPremium:</label>
        <select id="isPremium" name="isPremium" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
          <option value="premium">Premium</option>
          <option value="non-premium">Non-Premium</option>
        </select>
      </div>

      <div class="flex items-center space-x-2">
        <label for="releaseDate" class="w-1/4 font-bold text-xl text-yellow-500">Release Date:</label>
        <input type="date" id="releaseDate" name="releaseDate" value="{{ old('releaseDate') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="source" class="w-1/4 font-bold text-xl text-yellow-500">Source:</label>
        <input type="text" id="source" name="source" value="{{ old('source') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="season" class="w-1/4 font-bold text-xl text-yellow-500">Season:</label>
        <input type="number" min="1" id="season" name="season"  value="{{ old('season') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <div class="flex items-center space-x-2">
        <label for="duration" class="w-1/4 font-bold text-xl text-yellow-500">Duration:</label>
        <input type="text" placeholder="e.g., 1h 30m" id="duration" name="duration" value="{{ old('duration') }}" class="w-3/4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-900 text-white">
      </div>

      <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-md transition-colors font-bold w-1/6">Add Media</button>
    </form>
  </div>
</div>
@endsection
