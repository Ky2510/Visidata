<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    @auth
                    <a class="nav-link active" aria-current="page" href="">Hello, {{ auth()->user()->name }}</a>
                    @endauth
                </li>
                <li class="nav-item">
                    @auth
                    <a class="nav-link active" aria-current="page" href="{{ route('logout') }}"> Logout
                        {{-- <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Logout</button>
                        </form> --}}
                    </a>
                    @endauth
                </li>

            </ul>
        </div>
    </div>
</nav>