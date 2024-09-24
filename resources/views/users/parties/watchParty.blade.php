@extends('layouts.master')

@section('title', 'Watch Party')

@section('css')
@endsection

@section('content')
<div class="flex mb-8" x-data="{ showModal: false, showMembersModal: false }">
    <div class="w-3/5 bg-zinc-900 p-6 rounded-md shadow-lg mx-4">
        <iframe class="w-full rounded-md mb-4 aspect-video"
            src="https://www.youtube.com/embed/{{ $media->source }}"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
        <h1 class="text-white text-3xl font-bold mb-2">{{ $media->title }}</h1>
        <p class="text-white mb-2">{{ $media->description }}</p>
        <p class="text-white mb-2">Rating: {{ $media->rating }}/10</p>
        <p class="text-white mb-2">Release Date: {{ $media->released_date }}</p>
        <p class="text-white mb-2">Genres: {{ $genres }}</p>

        <button @click="showModal = true" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Leave Party</button>

        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
            <div class="bg-yellow-400 p-4 rounded-lg w-1/3" @click.away="showModal = false">
                <h2 class="text-2xl font-bold mb-4">Are you sure you want to leave the party?</h2>
                <div class="flex justify-between">
                    <button @click="showModal = false" class="bg-black text-white px-4 py-2 rounded">Cancel</button>
                    <form action="{{ route('wp.leave', $party->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="w-2/5 bg-zinc-800 p-6 rounded-md shadow-lg mx-4 flex flex-col h-screen">
        <div class="flex items-center justify-between mb-4 border-b-2 border-yellow-400">
            <h2 class="text-white text-2xl font-bold">{{ $party->name }}</h2>
            <button @click="showMembersModal = true" class="text-white">
                <i class="fa fa-users"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto mb-4">
            @foreach($chats as $chat)
            <div class="mb-4 flex {{ $chat->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs {{ $chat->user_id == auth()->id() ? 'bg-yellow-400 text-black' : 'bg-gray-300 text-black' }} p-2 rounded-lg">
                    <div class="text-sm text-gray-500">
                        {{ $chat->user_id == auth()->id() ? 'You' : $chat->user->name }}
                    </div>
                    <div class="text-black rounded-lg">
                        {{ $chat->message }} <span class="ml-2 text-xs">{{ $chat->created_at->format('H:i') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <form action="{{ route('wp.sendMessage', $party->id) }}" method="POST" class="mt-auto">
            @csrf
            <div class="flex">
                <input type="text" name="message" class="flex-1 p-2 rounded-l-lg" placeholder="Type a message..." autocomplete="off">
                <button type="submit" class="bg-white text-black px-4 py-2 rounded-r-lg"><i class="mt-1 fa fa-paper-plane text-yellow-500 hover:text-yellow-600 text-2xl"></i></button>
            </div>
        </form>
    </div>

    <div x-show="showMembersModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" style="display: none;">
        <div class="bg-yellow-400 p-4 rounded-lg w-1/3" @click.away="showMembersModal = false">
            <h2 class="text-2xl font-bold mb-4">Party Members</h2>
            <ul>
                @foreach($party->participants as $participant)
                    <li class="mb-2 text-xl"><i class="bi bi-person-fill mr-2"></i>{{ $participant->name }}</li>
                @endforeach
            </ul>
            <button @click="showMembersModal = false" class="mt-4 bg-black text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
@endsection
