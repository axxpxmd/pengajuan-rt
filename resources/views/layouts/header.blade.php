<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <h1><a href="{{ url('/') }}">SIPESAT</a></h1>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ url()->current() == url('/') ? '#hero' : url('/') }}">Beranda</a></li>
                @guest
                <li><a class="getstarted scrollto" href="{{ url('/login') }}"><i class="bi bi-arrow-right m-r-5"></i>Login</a></li>
                @else
                <li><a class="nav-link scrollto" href="{{ url()->current() == url('/') ? '#hero' : url('/') }}">Pengajuan</a></li>
                <li class="dropdown"><a href="#"><span>Hello, <span class="font-weight-bold ml-1">{{ Auth::user()->anggota->nama }}</span></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
