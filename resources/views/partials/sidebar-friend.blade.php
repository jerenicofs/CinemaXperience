<div class="w-1/4 h-screen p-5">
    <div class="mb-5">
        <h2 class="SideTitle">Friends</h2>
        <ul>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{route('friendlist')}}" class="inline-block border-b-2 border-transparent hover:border-current">Your Friends</a>
            </li>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{route('addfriend')}}" class="inline-block border-b-2 border-transparent hover:border-current">Add Friends</a>
            </li>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{route('friendrequests')}}" class="inline-block border-b-2 border-transparent hover:border-current">Pending Requests</a>
            </li>
        </ul>
    </div>
    <div>
        <h2 class="SideTitle">Watch Party</h2>
        <ul>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{ route('wp.show') }}" class="inline-block border-b-2 border-transparent hover:border-current">Your Parties</a>
            </li>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{ route('wp.create') }}" class="inline-block border-b-2 border-transparent hover:border-current">Create Parties</a>
            </li>
            <li class="my-3 transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                <a href="{{ route('wp.find') }}" class="inline-block border-b-2 border-transparent hover:border-current">Find Parties</a>
            </li>
        </ul>
    </div>
</div>

<div class="garis bg-stone-800 w-2 h- m-8"></div>
