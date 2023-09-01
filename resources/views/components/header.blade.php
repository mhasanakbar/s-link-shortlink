<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm bg-body-tertiary rounded">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav" style="font-size: 18px">
            <li class="nav-item ml-3">
                @auth
                <a class="nav-link" href="{{ route('home') }}" style="font-weight: bold">Beranda</a>
                @endauth
            </li>
            <li class="nav-item ml-3">
                @auth
                <a class="nav-link" href="{{ route('app.link.index') }}" style="font-weight: bold">Riwayat</a>
                @endauth
            </li>
            <li class="nav-item ml-3">
                @auth
                <a class="nav-link" href="{{ route('profile') }}" style="font-weight: bold">Profil</a>
                @endauth
            </li>
            <li class="nav-item ml-3">
    @auth
        @if (Auth::user()->id === 1)
            <a class="nav-link" href="{{ route('user') }}" style="font-weight: bold">User</a>
        @endif
    @endauth
</li>
        </ul>

        <!-- Move the user-related links to the right -->
        <ul class="navbar-nav ml-auto" style="font-size: 18px">
            @if (Auth::check())
                <li class="nav-item mr-3 mt-2">
                    <span class="user-name" style="font-weight: light">{{ Auth::user()->username }}</span>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link text-danger" href="{{ route('logout') }}" style="font-weight: bold">Logout</a>
                </li>
            @else
                <li class="nav-item mr-3">
                    <a class="nav-link text-info" href="{{ route('login') }}" style="font-weight: bold">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

