<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <!-- Font inter dr google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/partials/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/partials/footer.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    @yield('css')
    <style>
        html,
        body {
            min-height: 100%;
            height: auto;
            margin: 0;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        body {
            background-color: #262422;
            font-family: 'Inter', sans-serif;
            font-weight: 700px;
        }

        .flex-row-admin {
            flex-direction: row;
        }

        ::-webkit-scrollbar {
            width: 12px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #ffd717;
            border-radius: 6px;
            border: 3px solid #2c2f33;
        }

        ::-webkit-scrollbar-track {
            background: #333;
            border-radius: 6px;
        }
    </style>

    @vite('resources/css/app.css')

</head>
<body @auth class="{{ auth()->user()->role === 'admin' ? 'flex-row-admin' : '' }}" @endauth>
    @include('partials.navbar')

    <div class="content flex-grow @auth {{ auth()->user()->role === 'admin' ? 'admin-margin' : '' }} @endauth">
        @yield('content')
    </div>

    @auth
        @if(auth()->user()->role !== 'admin')
            @include('partials.footer')
        @endif
    @else
        @include('partials.footer')
    @endauth


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{asset('js/Carousel.js')}}"></script>
</body>
</html>
