<header>
    <!-- Logo -->
    <img src="{{ asset('assets/image/logo_hima.png') }}" alt="Logo HMTI" class="logo">

    <nav>
        <ul>
            <li><a href="{{ route('user.beranda') }}">HOME</a></li>
            <li><a href="{{ route('user.divisi') }}">DIVISI</a></li>
            <li><a href="{{ route('user.profil') }}">PROFIL</a></li>
            <li><a href="{{ route('user.berita') }}">BERITA</a></li>
            <li><a href="{{ route('user.pendaftaran') }}">PENDAFTARAN</a></li>
            <li><a href="{{ route('user.prestasi') }}">PRESTASI MAHASISWA</a></li>
            <li><a href="{{ route('user.aspirasi') }}">KOTAK ASPIRASI</a></li>
        </ul>
    </nav>

    <button class="login-button">LOGIN</button>
</header>
