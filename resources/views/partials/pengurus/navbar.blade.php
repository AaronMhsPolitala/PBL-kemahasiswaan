{{-- resources/views/partials/pengurus/navbar.blade.php --}}
<header class="topbar">
  <div class="user-profile">
    <span>Hi, {{ Auth::user()->name ?? 'Pengurus' }}</span>
    <img src="https://i.pravatar.cc/150?u={{ Auth::id() }}" alt="User">
  </div>
</header>
