<li class="nav-item dropdown nav-item-container">
    <a class="nav-link dropdown-toggle ddl-items text-black transition duration-300 ease-in-out transform hover:bg-yellow-400 hover:scale-105" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Welcome, {{ auth()->user()->name }}
    </a>
    <ul class="dropdown-menu bg-black text-white mt-2 rounded shadow-lg z-20">
        <li>
            <a class="dropdown-item py-2 px-4 hover:bg-yellow-500 transition duration-300 ease-in-out" href="{{ route('user.dashboard') }}" style="color: white !important;">
                <i class="bi bi-person-circle mr-2"></i> Profile
            </a>
        </li>
        <li><hr class="dropdown-divider border-gray-700"></li>
        <li>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item py-2 px-4 hover:bg-yellow-500 transition duration-300 ease-in-out w-full text-left" style="color: white !important;">
                    <i class="bi bi-box-arrow-right mr-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</li>
