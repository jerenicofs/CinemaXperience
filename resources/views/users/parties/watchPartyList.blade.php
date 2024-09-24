@extends('layouts.master')

@section('title', 'Watch Party List')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/friendlist.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="bg-neutral-900 text-white">
    <div class="flex">
        @include('partials.sidebar-friend')

        <div class="content-area flex-1 p-8">
            <h1 class="border-l-4 border-yellow-400 pl-2 text-white text-4xl font-bold mb-6">Your Parties</h1>
            @if(session('message'))
            <div x-data="{ show: true }" x-show="show" class="bg-yellow-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                <span class="text-2xl">{{ session('message') }}</span>
                <button @click="show = false" class="text-white">X</button>
            </div>
            @endif

            @if($parties->isEmpty())
                <div class="text-center">
                    <div class="font-black mb-4">You haven't joined any party yet.</div>
                    <a href="{{ route('wp.create') }}" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 hover:text-black">Click here to create your party</a>
                </div>
            @else
                <div class="grid grid-cols-3 gap-4">
                    @foreach($parties as $party)
                        <a href="{{ route('wp.watch', $party->id) }}" class="party-card bg-gray-800 p-4 block rounded-xl">
                            <h3 class="text-3xl mb-2 font-bold">{{ $party->name }}</h3>
                            <p>Currently watching: {{ $party->media->title }}</p>
                            <p>Created on: {{ $party->created_at->toFormattedDateString() }}</p>
                            <p>Members: {{ $party->member_count }} / 8</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
