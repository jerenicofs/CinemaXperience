@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
<style>
    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    .typing-effect {
        overflow: hidden;
        white-space: nowrap;
        animation: typing 8s steps(60, end);
    }

    .container {
        background-color: transparent;
        color: white;
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, color 0.3s ease-in-out, border-color 0.3s ease-in-out;
        border-color: transparent;
    }

    .container:hover {
        transform: scale(1.05);
        background-color: #ffd700;
        color: black;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border-color: black;
    }
</style>
@endsection

@section('content')
<div class="mt-12 ml-8 text-4xl md:text-6xl font-bold typing-effect w-fit text-yellow-300"> Welcome back, {{ auth()->user()->name }}!</div>

<div class="flex flex-wrap justify-around gap-4 mt-12 mx-8">
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
    <a href="{{ route('users.index') }}">
            <i class="fas fa-users fa-3x text-blue-500 mb-4"></i>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Total Users</h1>
            <span class="text-6xl md:text-8xl font-bold">{{ $users }}</span>
        </a>
    </div>
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
    <a href="{{ route('medias.index') }}">
        <i class="fas fa-film fa-3x text-red-500 mb-4"></i>
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Total Medias</h1>
        <span class="text-6xl md:text-8xl font-bold">{{ $movies }}</span>
    </a>
    </div>
</div>
@endsection
