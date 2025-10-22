<aside class="sidebar">
   <div class="sidebar-header">
    <img src="{{ asset('assets/image/logo_hima.png') }}" alt="Logo HMTI" class="logo">
    <i class="fas fa-bars menu-icon"></i>
</div>

  <nav class="sidebar-nav">
    <ul>
      <li>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="fas fa-home-alt nav-icon"></i><span class="menu-text"> Dashboard</span>
        </a>
      </li>

      <li class="nav-title">Admin</li>

      <li><a href="#"><i class="fas fa-user nav-icon"></i><span class="menu-text"> Data User</span></a></li>
      <li>
        <details>
          <summary><i class="fas fa-users nav-icon"></i><span class="menu-text">Data Anggota Hima-TI</span><i class="fas fa-chevron-down arrow-icon"></i></summary>
          <nav class="items">
            <a href="{{ route('admin.kelola-anggota-himati.index') }}">Kelola Anggota Hima-TI</a>
            <a href="{{ route('admin.calon-anggota.index') }}">Kelola Calon Anggota Hima-TI</a>
            <a href="{{ route('admin.calon-anggota-tahap-1.index') }}">Kelola Calon Anggota Hima-TI Tahap 1</a>
            <a href="{{ route('admin.calon-anggota-tahap-2.index') }}">Kelola Calon Anggota Hima-TI Tahap 2</a>
          </nav>
        </details>
      </li>
      <li><a href="#"><i class="fas fa-sitemap nav-icon"></i><span class="menu-text"> Data Divisi</span></a></li>
      <li><a href="#"><i class="fas fa-user-friends nav-icon"></i><span class="menu-text"> Data Anggota Per-Divisi</span></a></li>
      <li><a href="{{ route('admin.prestasi.index') }}" class="{{ request()->routeIs('admin.prestasi.index') ? 'active' : '' }}"><i class="fas fa-trophy nav-icon"></i><span class="menu-text"> Data Prestasi Mahasiswa </span></a></li>
      <li><a href="{{ route('admin.mahasiswa-bermasalah') }}" class="{{ request()->routeIs('admin.mahasiswa-bermasalah') ? 'active' : '' }}"><i class="fas fa-exclamation-triangle nav-icon"></i><span class="menu-text"> Data Mahasiswa Bermasalah</span></a></li>
      <li><a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.index') ? 'active' : '' }}"><i class="fas fa-newspaper nav-icon"></i><span class="menu-text"> Data Berita</span></a></li>
      <li><a href="{{ route('admin.aspirasi.index') }}" class="{{ request()->routeIs('admin.aspirasi.index') ? 'active' : '' }}"><i class="fas fa-bullhorn nav-icon"></i><span class="menu-text"> Data Aspirasi</span></a></li>
      <li><a href="#"><i class="fas fa-cog nav-icon"></i><span class="menu-text"> Setting </span><i class="fas fa-chevron-down arrow-icon"></i></a></li>
    </ul>
  </nav>
</aside>
