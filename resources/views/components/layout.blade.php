<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-body">
    <div class="container-fluid">
        <h1 class="text-white me-4 d-lg-block d-none"><span class="text-warning">Katering</span>ME</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav my-3 flex-column d-lg-none">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('home') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('menu') }}">Menu Katering</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Pesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Invoice</a>
                </li>
            </ul>
            <form class="d-flex mb-3 mb-lg-0" role="search">
                <input class="form-control me-2" style="width: 400px" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning" type="submit">Search</button>
            </form>
        </div>
        <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                <img src="{{ Auth::user()->foto ? asset('storage/'.Auth::user()->foto) : 'https://placehold.co/40?text=PP' }}" alt="mdo" width="32" height="32" class="rounded-circle">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu text-small" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 34px);">
                <li><a class="dropdown-item" href="{{ route('profil') }}">Profil</a></li>
                <li><a class="dropdown-item" href="#">Reset Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">Log out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-2 col-lg-3 d-lg-block d-none full bg-white shadow">
            <ul class="nav mt-5 flex-column fw-bold">
                <li class="nav-item text-center my-2">
                    <span class="text-secondary">MENU</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('home') }}">Dashboard</a>
                </li>
                @can('merchant')
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('menu') }}">Kelola Menu</a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('pesanan') }}">Pesanan</a>
                </li>
            </ul>
        </div>
        <div class="col-xl-10 col-lg-9 col-md-12">
            <div class="m-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
