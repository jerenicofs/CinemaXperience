@extends('layouts.master')

@section('title', 'Landing Page')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landingPage.css') }}">
@endsection

@section('content')

@if(session()->has('success'))
<div style="display: flex; justify-content: center; align-items :center">
    <div class="alert alert-success alert-dismissible fade show custom-alert-success" style="width: 20rem" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
@endif

@if(session()->has('loginError'))
<div style="display: flex; justify-content: center; align-items :center">
    <div class="alert alert-danger alert-dismissible fade show custom-alert-login-error" style="width: 20rem" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
</div>
@endif


<div class="main-content">

    <div class="hero-section">

        <div class="Scrolling_Background">
        <div class="photo photo-1"></div>
        <div class="photo photo-2"></div>
        <div class="photo photo-3"></div>
        <div class="photo photo-4"></div>
        <div class="photo photo-5"></div>
        </div>

        <div class="Scrolling_Background">
        <div class="photo photo-1"></div>
        <div class="photo photo-2"></div>
        <div class="photo photo-3"></div>
        <div class="photo photo-4"></div>
        <div class="photo photo-5"></div>
        </div>


        <div class="hero-content">
            <h1 class="animate">Discover, Watch, Repeat.</h1>
            <p>Enter your email to start</p>
            <form class="email-form" method="POST">
                <input type="email" placeholder="Email Address" id="email-before">
                <button>Login</button>
            </form>
        </div>

        <div id="loginModal" class="login-modal" style="display:none;">
            <div class="login-container">
                <span class="close-button" onclick="closeModal()">&times;</span>
                <h2>Log In</h2>
                <form method="POST" action="/login">
                    @csrf
                    <input class="email" name="email" type="email" placeholder="Email" id="email-after">
                    <input class="password" name="password" type="password" placeholder="Password" >
                    <div class="checkbox-container">
                        <input type="checkbox" id="rememberMe" name="remember">
                        <label for="rememberMe" style="color: white">Remember Me</label>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>
            </div>
        </div>


    </div>
</div>

<script>
    function openModal() {
        document.getElementById('loginModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('loginModal').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', () => {
        const loginButton = document.querySelector('.email-form button');
        loginButton.addEventListener('click', function(event) {
            event.preventDefault();
            const email = document.getElementById('email-before').value;
            document.getElementById('email-after').value = email;
            openModal();
        });
    });
</script>

@endsection
