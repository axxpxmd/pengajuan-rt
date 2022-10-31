<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <h1><a href="{{ url('/') }}">SIPRADA</a></h1>
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto" href="{{ url()->current() == url('/') ? '#hero' : url('/') }}">Beranda</a></li>
                <li><a class="nav-link scrollto" href="{{ url()->current() == url('/') ? '#tutorial' : url('tutorial') }}">Tutorial</a></li>
                @guest
                <li><a class="getstarted scrollto" href=""><i class="bi bi-arrow-right m-r-5"></i>Login</a></li>
                @else
                <li class="dropdown"><a href="#"><span>Hello, <span class="font-weight-bold ml-1">{{ Auth::user()->nama }}</span></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="">Profile</a></li>
                        <li>
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="" method="POST" style="display: none;">@csrf</form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>
</header>
