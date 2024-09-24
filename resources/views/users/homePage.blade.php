@extends('layouts.master')

@section('title', 'Home Page')

@section('css')
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">

@endsection

@section('content')

<h1 class="TopTitle text-2xl font-bold" >Trending Watches</h1>
    <div id="carousel">
        <div class="slider">
          <div class="item">
            <img src="assets/HomePage/EOY.jpg" alt="" />
            <p class = info >Extraordinary you</p>
          </div>
          <div class="item">
            <img src="assets/HomePage/Qot.jpg" alt="" />
            <p class = info>Queen Of Tears</p>
          </div>
          <div class="item">
            <img src="assets/HomePage/WYWS.jpg" alt="" />
            <p class = info>While You Were Sleeping</p>
          </div>
          <div class="item">
            <img src="assets/HomePage/obs.jpg" alt="" />
            <p class = info>Our Beloved Summer</p>
          </div>
          <div class="item">
            <img src="assets/HomePage/EOY.jpg" alt="" />
            <p class = info>Extraordinary You</p>
          </div>
          <button id="next">></button>
          <button id="prev"><</button>
        </div>

    </div>

    <div class="border my-4"></div>
    @if(session()->has('success'))
    <div style="display: flex; justify-content: center; align-items :center">
        <div class="alert alert-success alert-dismissible fade show custom-alert-success" style="width: 20rem" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @auth
        @if(auth()->user()->role === 'member')

        <h2 class="TopTitle text-2xl font-bold">ONLY FOR MEMBER</h2>
        <div class="hero-section flex flex-wrap space-x-1">
        @foreach ($medias as $media)
            @if($media->isPremium === 1)
            <div id="card" class="cursor-pointer" data-id="{{ $media->id }}" data-title="{{ $media->title }}" data-description="{{ $media->description }}" data-rating="{{ $media->rating }}" data-release="{{ $media->released_date }}" data-image="{{ asset('storage/' . $media->poster) }}">
                <div class="photo">
                    <img src="{{ asset('storage/' . $media->poster) }}" alt="{{ $media->title }}" class="object-cover w-full h-full">
                </div>
                <div class="title">
                    <p>{{ $media->title }}</p>
                </div>
            </div>
            @endif
        @endforeach
        </div>
        <div class="border my-4"></div>
        @endif
    @endauth



<h2 class="TopTitle text-2xl font-bold">Recently Watched</h2>
<div class="hero-section flex flex-wrap space-x-1">
    <div id="card" class="cursor-pointer" data-id="6" data-title="Queen of Tears" data-description="Description for Queen of Tears" data-rating="8.5" data-release="2021-12-15" data-image="{{ asset('assets/HomePage/Qot.jpg') }}">
        <div class="photo">
            <img src="{{ asset('assets/HomePage/Qot.jpg') }}" alt="Qot" class="object-cover w-full h-full">
        </div>
        <div class="title">
            <p>Queen of Tears</p>
        </div>
    </div>
    <div id="card" class="cursor-pointer" data-id="3" data-title="Descendant Of The Sun" data-description="Description for Descendant Of The Sun" data-rating="9.0" data-release="2016-02-24" data-image="{{ asset('assets/HomePage/DOTS.jpg') }}">
        <div class="photo">
            <img src="{{ asset('assets/HomePage/DOTS.jpg') }}" alt="DOTS" class="object-cover w-full h-full">
        </div>
        <div class="title">
            <p>Descendant Of The Sun</p>
        </div>
    </div>
</div>



<div class="border my-4"></div>

<h2 class="TopTitle text-2xl font-bold">Korean Drama</h2>
<div class="hero-section flex flex-wrap space-x-1">
@foreach ($medias as $media)
    @if($media->genre->contains('genre_type', 'korean-drama'))
    <div id="card" class="cursor-pointer" data-id="{{ $media->id }}" data-title="{{ $media->title }}" data-description="{{ $media->description }}" data-rating="{{ $media->rating }}" data-release="{{ $media->released_date }}" data-image="{{ asset('storage/' . $media->poster) }}">
        <div class="photo">
            <img src="{{ asset('storage/' . $media->poster) }}" alt="{{ $media->title }}" class="object-cover w-full h-full">
        </div>
        <div class="title">
            <p>{{ $media->title }}</p>
        </div>
    </div>
    @endif
@endforeach
</div>

<div class="border my-4"></div>

<h2 class="TopTitle text-2xl font-bold">Anggap Saja Action Drama</h2>
<div class="hero-section flex flex-wrap space-x-1">
@foreach ($medias as $media)
    @if($media->genre->contains('genre_type', 'action'))
    <div id="card" class="cursor-pointer" data-id="{{ $media->id }}" data-title="{{ $media->title }}" data-description="{{ $media->description }}" data-rating="{{ $media->rating }}" data-release="{{ $media->released_date }}" data-image="{{ asset('storage/' . $media->poster) }}">
        <div class="photo">
            <img src="{{ asset('storage/' . $media->poster) }}" alt="{{ $media->title }}" class="object-cover w-full h-full">
        </div>
        <div class="title">
            <p>{{ $media->title }}</p>
        </div>
    </div>
    @endif
@endforeach
</div>

<div class="border my-4"></div>

<h2 class="TopTitle text-2xl font-bold">Melodrama</h2>
<div class="hero-section flex flex-wrap space-x-1">
@foreach ($medias as $media)
    @if($media->genre->contains('genre_type', 'melodrama'))
    <div id="card" class="cursor-pointer" data-id="{{ $media->id }}" data-title="{{ $media->title }}" data-description="{{ $media->description }}" data-rating="{{ $media->rating }}" data-release="{{ $media->released_date }}" data-image="{{ asset('storage/' . $media->poster) }}">
        <div class="photo">
            <img src="{{ asset('storage/' . $media->poster) }}" alt="{{ $media->title }}" class="object-cover w-full h-full">
        </div>
        <div class="title">
            <p>{{ $media->title }}</p>
        </div>
    </div>
    @endif
@endforeach
</div>

<div class="border my-4"></div>

<div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 transition-opacity duration-500 opacity-0 pointer-events-none">
    <div class="rounded-lg shadow-lg p-6 w-11/12 lg:w-3/4 transition-transform duration-500 transform scale-75" style="background-color: #262422;">
        <span class="close text-gray-500 hover:text-gray-800 text-2xl cursor-pointer transition duration-500">&times;</span>
        <div class="popup-content flex flex-col lg:flex-row items-start">
            <img id="popup-image" class="w-full lg:w-1/3 rounded-lg mb-4 lg:mb-0 lg:mr-4 object-cover" src="" alt="Image">
            <div class="lg:ml-4">
                <h2 id="popup-title" class="text-5xl font-bold text-white mb-2"></h2>
                <p id="popup-description" class="text-white text-lg mb-2"></p>
                <p id="popup-rating" class="text-white text-lg mb-2"></p>
                <p id="popup-release" class="text-white text-lg mb-2"></p>
                <a id="popup-watch-now" href="#" class="flex justify-center items-center text-black bg-[#ffd717] px-7 py-2 mt-6 mb-4 text-center rounded-full font-extrabold text-lg w-48">Watch Now</a>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    var popup = document.getElementById("popup");
    var span = document.getElementsByClassName("close")[0];
    var cards = document.querySelectorAll("#card");
    var watchRouteTemplate = "{{ route('watch', ['id' => '__ID__']) }}";
    cards.forEach(function(card) {
        card.addEventListener("click", function() {
            var id = card.getAttribute("data-id");
            var title = card.getAttribute("data-title");
            var description = card.getAttribute("data-description");
            var rating = card.getAttribute("data-rating");
            var release = card.getAttribute("data-release");
            var image = card.getAttribute("data-image");
            document.getElementById("popup-title").innerText = title;
            document.getElementById("popup-description").innerText = description;
            document.getElementById("popup-rating").innerText = "Rating: " + rating + "/10";
            document.getElementById("popup-release").innerText = "Release Date: " + release;
            document.getElementById("popup-image").src = image;
            document.getElementById("popup-watch-now").href = watchRouteTemplate.replace('__ID__', id);
            popup.classList.remove("opacity-0", "pointer-events-none", "scale-75");
            popup.classList.add("opacity-100", "pointer-events-auto", "scale-100");
        });
    });

    span.onclick = function() {
        popup.classList.remove("opacity-100", "pointer-events-auto", "scale-100");
        popup.classList.add("opacity-0", "pointer-events-none", "scale-75");
    }

    window.onclick = function(event) {
        if (event.target == popup) {
            popup.classList.remove("opacity-100", "pointer-events-auto", "scale-100");
            popup.classList.add("opacity-0", "pointer-events-none", "scale-75");
        }
    }
</script>

    <script>
    let items = document.querySelectorAll(".slider .item");
    let next = document.getElementById("next");
    let prev = document.getElementById("prev");

    let active = 2;
    function loadShow() {
    let stt = 0;
    items[active].style.transform = `scale(1)`;
    items[active].style.zIndex = 1;
    items[active].style.filter = "none";
    items[active].style.opacity = 1;
    for (var i = active + 1; i < items.length; i++) {
        stt++;
        items[i].style.transform = `translateX(${120 * stt}px) scale(${
        1 - 0.2 * stt
        })`;
        items[i].style.zIndex = -stt;
        items[i].style.filter = "blur(5px)";
        items[i].style.opacity = stt > 2 ? 0 : 0.6;
    }
    stt = 0;
    for (var i = active - 1; i >= 0; i--) {
        stt++;
        items[i].style.transform = `translateX(${-120 * stt}px) scale(${
        1 - 0.2 * stt
        })`;
        items[i].style.zIndex = -stt;
        items[i].style.filter = "blur(5px)";
        items[i].style.opacity = stt > 2 ? 0 : 0.6;
    }
    }
    loadShow();
    next.onclick = function () {
    // active = active + 1 < items.length ? active + 1 : active;
    active = (active + 1) % items.length;
    loadShow();
    };
    prev.onclick = function () {
    // active = active - 1 >= 0 ? active - 1 : active;
    if(active == 0){
        active = items.length - 1;
    }else{
        active--;
    }
    loadShow();
    };
    </script>


@endsection
