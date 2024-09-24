@extends('layouts.master')

@section('title', 'Find Party')

@section('css')
<link rel="stylesheet" href="{{ asset('css/friendlist.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
<div class="bg-neutral-900 text-white flex">
    @include('partials.sidebar-friend')

    <div class="flex-1 p-5">
        @if(session('message'))
            <div x-data="{ show: true }" x-show="show" class="bg-yellow-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                <span class="text-2xl">{{ session('message') }}</span>
                <button @click="show = false" class="text-white">X</button>
            </div>
        @endif

        <div class="mb-10">
            <h1 class="border-l-4 border-yellow-400 pl-2 text-white text-4xl font-bold mb-3">Find Party</h1>
            <form action="{{ route('wp.find') }}" method="GET" class="space-y-4">
                <input type="text" name="search_id" placeholder="Input Party's Name" class="text-black p-1 rounded w-1/8">
                <button type="submit" class="py-1 px-2 bg-yellow-400 rounded text-black font-bold">Search</button>
            </form>

            @if(isset($searchResult) && $searchResult->isNotEmpty())
                <div class="mt-5">
                    <p class="text-2xl mb-4">Found party:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($searchResult as $party)
                            <div class="bg-yellow-400 p-2 rounded flex items-center justify-between">
                                <span class="text-2xl">{{ $party->name }}</span>
                                <form action="{{ route('wp.join', $party->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-black text-white px-2 py-1 rounded">Join</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if(request()->has('search_id'))
                    <p class="text-white-500 mt-8 text-2xl">No party found.</p>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
