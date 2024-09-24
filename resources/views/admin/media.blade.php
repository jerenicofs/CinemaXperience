@extends('layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
<style>
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

    .TopTitle {
        border-left: 0.5rem solid red;
        color: white;
        padding-left: 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="TopTitle mt-12 ml-8 text-4xl md:text-6xl font-bold typing-effect w-fit text-yellow-300">MEDIA CRUD</div>

@if(session()->has('success'))
<div style="display: flex; justify-content: center; align-items :center">
    <div class="alert alert-success alert-dismissible fade show custom-alert-success" style="width: 20rem" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
@endif

<div class="flex flex-wrap justify-around gap-4 mt-12 mx-8">
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
     <a href="{{ route('medias.create') }}">
            <i class="bi bi-person-plus-fill text-orange-500 fas fa-3x mb-4"></i>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Add New Media</h1>
            <span class="text-2xl md:text-4xl font-bold">Here you can add a new media as you wish...</span>
        </a>
    </div>
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
        <a href="{{ route('medias.view') }}">
            <i class="bi bi-eye-fill fas fa-3x text-green-500 mb-4"></i>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">View Media</h1>
            <span class="text-2xl md:text-4xl font-bold">Go see your media lists...</span>
        </a>
    </div>
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
        <a href="{{ route('medias.view') }}">
            <i class="fas bi bi-tools fa-3x text-green-500 mb-4"></i>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Update Media</h1>
            <span class="text-2xl md:text-4xl font-bold">Update? Sounds quite interesting...</span>
        </a>
    </div>
    <div class="container flex-initial border rounded-lg shadow-md p-8 m-4 cursor-pointer w-full md:w-5/12 lg:w-1/3">
        <a href="{{ route('medias.view') }}">
            <i class="fas bi bi-trash3-fill fa-3x text-orange-500 mb-4"></i>
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Delete Media</h1>
            <span class="text-2xl md:text-4xl font-bold">Just dump those garbage...</span>
        </a>
    </div>
</div>
@endsection
