@extends('layouts.master')

@section('title', 'Media Details')

@section('css')
@endsection

@section('content')
<div class="flex flex-col min-h-screen" style="background-color: #262422;" x-data="reviewReplies()">
    <div class="flex flex-grow items-start justify-center mt-4">
        <div class="w-1/2 bg-zinc-900 p-6 rounded-md shadow-lg mx-4">
            <img src="{{ asset('storage/' . $media->poster) }}" alt="{{ $media->title }}" class="object-cover w-full h-96 rounded-md mb-4">
            <a href="{{ route('watch',  $media->id) }}"><h1 class="text-white text-3xl font-bold mb-2 hover:underline">{{ $media->title }}</h1></a>
            <p class="text-white mb-2">{{ $media->description }}</p>
            <p class="text-white mb-2">Rating: {{ $media->rating }}/10</p>
            <p class="text-white mb-2">Release Date: {{ $media->released_date }}</p>
            <p class="text-white mb-2">Genres: {{ $media->genre->implode('genre_type', ', ') }}</p>
        </div>
        <div class="w-1/2 bg-zinc-900 p-6 rounded-md shadow-lg mx-4 max-h-screen overflow-y-auto">
            <h2 class="text-white text-2xl font-bold mb-4">What they say about {{ $media->title }}</h2>
            <form x-data="{ comment: '' }" action="{{ route('reviews.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="media_id" value="{{ $media->id }}">
                <textarea name="comment" x-model="comment" class="w-full p-2 rounded-md mb-2 bg-transparent text-white" rows="2" placeholder="Add a review..."></textarea>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Comment</button>
                    <button type="button" @click="comment = ''" class="bg-gray-500 text-white px-2 py-1 rounded-md">Cancel</button>
                </div>
            </form>
            <div class="space-y-4">
                @foreach($media->reviews->sortByDesc('created_at') as $review)
                    <div class="bg-zinc-800 p-4 rounded-lg" x-data="{ showReplies: false, showOptions: false, editingReview: false, editingReply: null, showReplyOptions: null }">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                @if($review->user->profile_picture)
                                    <img src="{{ asset('storage/' . $review->user->profile_picture) }}" alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full mr-2">
                                @else
                                    <svg class="w-10 h-10 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                @endif
                                <div class="flex flex-col">
                                    <h3 class="text-white font-semibold">{{ $review->user->name }}</h3>
                                    <span class="text-gray-400 text-sm">{{ formatTimestamp($review->created_at) }}</span>
                                </div>
                            </div>
                            @if($review->user_id === Auth::id())
                                <div class="relative">
                                    <button @click="showOptions = !showOptions" class="text-gray-400 focus:outline-none">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 5c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 12c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 19c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z"/>
                                        </svg>
                                    </button>
                                    <div x-show="showOptions" @click.away="showOptions = false" class="absolute right-0 mt-2 w-28 bg-zinc-800 rounded-md shadow-lg z-20" x-cloak>
                                        <button @click="editingReview = !editingReview; showOptions = false" class="block text-left px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 w-full">Edit</button>
                                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-700 w-full">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div x-show="editingReview" class="mt-2" x-cloak>
                            <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="comment" class="w-full p-2 rounded-md mb-2" rows="2">{{ $review->comment }}</textarea>
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Update Review</button>
                                    <button type="button" @click="editingReview = false" class="text-gray-500">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <p class="text-gray-400" x-show="!editingReview">{{ $review->comment }}</p>
                        <div class="ml-8 mt-4">
                            <button class="text-yellow-400 font-semibold focus:outline-none flex items-center" @click="showReplies = !showReplies">
                                <span>View replies ({{ $review->reply->count() }})</span>
                                <svg x-show="showReplies" class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="showReplies" class="mt-2 space-y-2" x-cloak>
                                @foreach($review->reply as $reply)
                                    <div class="bg-gray-700 p-3 rounded-lg mb-2" x-data="{ showReplyOptions: false, editingReply: false, replyText: '{{ $reply->reply }}' }">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                @if($reply->user->profile_picture)
                                                    <img src="{{ asset('storage/' . $reply->user->profile_picture) }}" alt="{{ $reply->user->name }}" class="w-6 h-6 rounded-full mr-2">
                                                @else
                                                    <svg class="w-6 h-6 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                    </svg>
                                                @endif
                                                <div class="flex space-x-2">
                                                    <h4 class="text-white font-semibold">{{ $reply->user->name }}</h4>
                                                    <span class="text-gray-400 text-sm">{{ formatTimestamp($reply->created_at) }}</span>
                                                </div>
                                            </div>
                                            @if($reply->user_id === Auth::id())
                                                <div class="relative">
                                                    <button @click="showReplyOptions = !showReplyOptions" class="text-gray-400 focus:outline-none">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 5c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 12c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zM12 19c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2z"/>
                                                        </svg>
                                                    </button>
                                                    <div x-show="showReplyOptions" @click.away="showReplyOptions = false" class="absolute right-0 mt-2 w-28 bg-zinc-800 rounded-md shadow-lg z-20" x-cloak>
                                                        <button @click="editingReply = !editingReply; showReplyOptions = false" class="block text-left px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 w-full">Edit</button>
                                                        <form action="{{ route('replies.destroy', $reply->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="block text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-700 w-full">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div x-show="editingReply" class="mt-2" x-cloak>
                                            <form action="{{ route('replies.update', $reply->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <textarea name="reply" x-model="replyText" class="w-full p-2 rounded-md mb-2" rows="2">{{ $reply->reply }}</textarea>
                                                <div class="flex space-x-2">
                                                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Update Reply</button>
                                                    <button type="button" @click="editingReply = false; replyText = '{{ $reply->reply }}'" class="text-gray-500">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <p class="text-gray-300" x-show="!editingReply">{{ $reply->reply }}</p>
                                    </div>
                                @endforeach
                                <form x-data="{ reply: '' }" action="{{ route('replies.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                    <textarea name="reply" x-model="reply" class="w-full p-2 rounded-md mb-2 bg-transparent text-white" rows="1" placeholder="Add a reply..."></textarea>
                                    <div class="flex space-x-2">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Reply</button>
                                        <button type="button" @click="reply = ''" class="bg-gray-500 text-white px-2 py-1 rounded-md">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@php
    function formatTimestamp($timestamp) {
        $now = new DateTime();
        $time = new DateTime($timestamp);
        $diff = $now->diff($time);

        if ($diff->y > 0) {
            return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
        } elseif ($diff->m > 0) {
            return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
        } elseif ($diff->d >= 7) {
            return floor($diff->d / 7) . ' week' . (floor($diff->d / 7) > 1 ? 's' : '') . ' ago';
        } elseif ($diff->d > 0) {
            return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->i > 0) {
            return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
        } else {
            return $diff->s . ' second' . ($diff->s > 1 ? 's' : '') . ' ago';
        }
    }
@endphp

<script>
    function reviewReplies() {
        return {
            showReplies: null,
            editingReview: null,
            editingReply: null,
            toggleReplies(reviewId) {
                this.showReplies = this.showReplies === reviewId ? null : reviewId;
            }
        };
    }
</script>
