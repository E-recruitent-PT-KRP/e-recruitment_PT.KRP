<div class="container position-relative d-flex align-items-center justify-content-between">

    <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        {{-- <img src="assets/img/logo.png" alt=""> --}}
        <h1 class="sitename">PT. Karya Rama Perkasa</h1>
        <span>.</span>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li><a href="#hero" class="active">Home<br></a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#menu">Promo</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#gallery">Gallery</a></li>
            @if (Auth::check() && Auth::user()->akses !== 'Karyawan')
            <li class="dropdown"><a href="#"><span>Karir</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="#">About Us</a></li>
                    {{-- <li><a href="{{ route('careeruser.index') }}">Lowongan Pekerjaan</a></li> --}}
                </ul>
            </li>
            @endif
            <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- <a class="btn-getstarted" href="{{ route('login') }}">Login/Register</a> --}}
    @if (Auth::check())
    <!-- Tampilkan nama user jika sudah login -->
    <div class="dropdown">
        <a class="btn-getstarted dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fas fa-user"></i>
            {{ Auth::user()->name }}
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <!-- Tampilkan Absensi hanya untuk role selain 'User' -->
            @if (Auth::check() && Auth::user()->akses !== 'User')
            <li>
                {{-- <a class="dropdown-item" href="{{ route('karyawan.absensi') }}">
                    Absensi
                </a> --}}
            </li>

            @endif

            <!-- Tentukan tautan Profile berdasarkan peran (akses) -->
            {{-- <li>
                @if (Auth::check() && Auth::user()->akses === 'User')
                <a class="dropdown-item" href="{{ route('pelamar.index') }}">
                    Profile
                </a>
                @else
                <a class="dropdown-item" href="{{ route('karyawan.profil') }}">
                    Profile
                </a>
                @endif
            </li> --}}

            <li>
                <a class="dropdown-item" href="{{ route('pelamar.index') }}">
                    Profil
                </a>
            </li>

            {{-- <li>
                @if(auth()->user()->pelamar) 
                    <!-- Jika pelamar sudah ada -->
                    <a class="dropdown-item" href="{{ route('pelamar.show') }}">
                        Profil
                    </a>
                @else
                    <!-- Jika pelamar belum ada -->
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        Profil
                    </a>
                @endif
            </li> --}}

            <!-- Logout -->
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @else
    <!-- Tampilkan tombol login/register jika belum login -->
    <a class="btn-getstarted" href="{{ route('login') }}">Login/Register</a>
    @endif

</div>