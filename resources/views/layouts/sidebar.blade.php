<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-text mx-3" style="font-size: 0.8rem">{{ config('app.name') }}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ class_active('home', 'home.edit') }}">
    <a class="nav-link" href="{{ route('home') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-item {{ class_active('permintaan.*') }}">
    <a class="nav-link" href="{{ route('permintaan.index') }}">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Permintaan</span>
    </a>
  </li>

  <li class="nav-item {{ class_active('prediksi.*') }}">
    <a class="nav-link" href="{{ route('prediksi.index') }}">
      <i class="fas fa-fw fa-question-circle"></i>
      <span>Prediksi</span>
    </a>
  </li>

  <li class="nav-item {{ class_active('produksi.*') }}">
    <a class="nav-link" href="{{ route('produksi.index') }}">
      <i class="fas fa-fw fa-boxes"></i>
      <span>Produksi</span>
    </a>
  </li>

  <li class="nav-item {{ class_active('galeri.*') }}">
    <a class="nav-link" href="{{ route('galeri.index') }}">
      <i class="fas fa-fw fa-images"></i>
      <span>Galeri</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>