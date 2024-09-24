@extends('layouts.master')

@section('title', 'Create Party')

@section('css')
<link rel="stylesheet" href="{{ asset('css/friendlist.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="bg-neutral-900 text-white">
    <div class="flex">
        @include('partials.sidebar-friend')

        <div class="flex-1 p-5">
            @if(Auth::user()->role == 'non-member')
            <div class="text-center">
                <div class="pl-2 text-white text-3xl font-bold mb-3">
                    Create party feature only available for members.
                </div>
                <a href="{{ route('subscription') }}" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 hover:text-black">Go subscribe now</a>

            </div>

            @else
                <h1 class="border-l-4 border-yellow-400 pl-2 text-white text-4xl font-bold mb-3">Create Party</h1>
                <form action="{{ route('wp.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="mb-4">
                        <label for="party_name" class="block text-white text-lg font-medium">Party Name:</label>
                        <input type="text" id="party_name" name="party_name" class="text-black p-1 rounded w-1/3" required>
                    </div>
                    <div class="mb-4">
                        <label for="media_id" class="block text-white text-lg font-medium">Select Movie:</label>
                        <select id="media_id" name="media_id" class="text-black p-1 rounded w-1/3" required>
                            @foreach($movies as $movie)
                                <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="friend_ids" class="block text-white text-lg font-medium">Select Friends:</label>
                        <select id="friend_ids" name="friend_ids[]" class="text-black p-1 rounded w-1/3" multiple required>
                            @foreach($friends as $friend)
                                <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="py-1 px-2 bg-yellow-400 rounded text-black font-bold">Create Party</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
