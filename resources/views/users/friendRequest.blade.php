@extends('layouts.master')

@section('title', 'Friend List')

@section('css')
<link rel="stylesheet" href="{{ asset('css/friendlist.css') }}">
@endsection

@section('content')
<div class="bg-neutral-900 text-white">
    <div class="flex">
        <!-- Sidebar -->

        @include('partials.sidebar-friend')
        <!-- Main Content -->
        <div class="w-3/4 p-5">

            <div class="mb-10">
                {{-- <h2 class="text-2xl font-semibold mb-3">Recently Contacted</h2> --}}
                <h1 class="TopTitle">Pending Request</h1>
                {{-- harusnya ini didalem page friend request --}}
                @if ($PendingRequests->isEmpty())
                <p class = "font-bold text-xl">No Pending Request Available</p>
                @else
                @foreach($PendingRequests as $request)
                <div class="inline-block  h-14">
                    <div class="flex space-x-4">
                        <div class="friend-item" >
                            <div class="friendcontainer items-center flex gap-3 w-full">
                                <div class="pic-container bg-black rounded-full w-1/24">
                                    <img src="{{$request->profile_picture}}" class="friend-img" alt="Pic">
                                </div>
                                <div class="nama text-black font-bold text-base flex text-center items-center w-9/12">
                                    {{$request->name}}
                                </div>
                                <div class="button flex gap-3">
                                    @if ($request->pivot->user_id == auth()->id())
                                    <form action="{{ route('friendrequests.cancel', $request->pivot->friend_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="friend-btn">Cancel</button>
                                    </form>
                                    @else
                                    <form action="{{ route('friendrequests.accept', $request->pivot->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="friend-btn">Accept</button>
                                    </form>
                                    <form action="{{ route('friendrequests.reject', $request->pivot->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="friend-btn">Decline</button>
                                    </form>
                                   @endif
                                </div>
                            </div>
                        </div>
                </div></div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
