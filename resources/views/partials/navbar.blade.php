@auth
    @if (auth()->user()->role === 'admin')
        @include('partials.navbar-admin')
    @else
        <div id="navbar">
            <div id="cinemaxperience-logo">
                <a href="/"><img src="{{ asset('assets/logo.png') }}" alt="LOGO CINEMAXPERIENCE" class="transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"></a>
            </div>

            <div class="mid-section flex space-x-60 ">
                @if (auth()->user()->role === 'non-member')
                    <div class="subscribe transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"><a href="{{ route('subscription') }}">Subscribe</a></div>
                @endif

                @if (auth()->user()->role !== 'admin')
                <div class="friend text-white transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"><a href="{{ route('friendlist') }}">Friends</a></div>
                @endif
            </div>
            {{-- <div class="friendnav"> --}}

            {{-- </div> --}}

            <div class="ddl">
                @if (auth()->user()->role === 'admin')
                    @include('partials.navbar-admin')
                @elseif (auth()->user()->role === 'member')
                    @include('partials.navbar-member')
                @else
                    @include('partials.navbar-non-member')
                @endif
            </div>
        </div>
    @endif
@endauth

@guest
    <div id="navbar">
        <div id="cinemaxperience-logo">
            <a href="/"><img src="{{ asset('assets/logo.png') }}" alt="LOGO CINEMAXPERIENCE"></a>
        </div>

        <div class="ddl">
            @if (Route::currentRouteName() == 'login')
                <a href="{{ route('signup') }}"><div class="sign-up transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">Sign Up</div></a>
            @else
                <a href="{{ route('login') }}"><div class="sign-up transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">Login</div></a>
            @endif
        </div>
    </div>
@endguest
