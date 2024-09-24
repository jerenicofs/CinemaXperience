<div class="admin-sidebar h-auto text-white flex flex-col p-4 top-0 left-0 w-64" style="background-image: linear-gradient(to right, black, #262422)">
    <div class="mb-8">
        <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/logo.png') }}" alt="LOGO CINEMAXPERIENCE" class="w-32 transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg"></a>
    </div>
    <ul class="flex flex-col mt-12 space-y-4 gap-y-12">
        <li class="nav-item transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:border-b-2 w-20">
            <a class="nav-link text-white flex items-center space-x-2" href="{{ route('medias.index') }}">
                <i class="bi bi-film"></i>
                <span>Media</span>
            </a>
        </li>
        <li class="nav-item transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:border-b-2 w-20">
            <a class="nav-link text-white flex items-center space-x-2" href="{{ route('users.index') }}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li>
        <li class="nav-item transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:border-b-2 w-20">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="nav-link text-white flex items-center space-x-2">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>

