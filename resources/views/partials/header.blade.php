<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo" style="height:40px; margin-right:10px;">
        <span class="text-white fs-4 fw-bold">E-NourJahit</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link text-white fw-bold text-uppercase" href="/">Utama</a>
          </li>
          <li class="nav-item {{ Request::is('tentangkami') ? 'active' : '' }}">
            <a class="nav-link text-white fw-bold text-uppercase" href="/tentangkami">Tentang Kami</a>
          </li>
          <li class="nav-item {{ Request::is('KatalogUmum') ? 'active' : '' }}">
            <a class="nav-link text-white fw-bold text-uppercase" href="/KatalogUmum">Katalog</a>
          </li>
          <li class="nav-item {{ Request::is('hubungi-kami') ? 'active' : '' }}">
            <a class="nav-link text-white fw-bold text-uppercase" href="/hubungi-kami">Hubungi Kami</a>
          </li>
        </ul>
        <div class="ms-lg-3">
          @if(Auth::check())
            <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4 fw-bold">Dashboard</a>
          @else
            <a href="{{ route('logmasuk') }}" class="btn btn-primary rounded-pill px-4 fw-bold">Log Masuk</a>
          @endif
        </div>
      </div>
    </nav>
  </div>

  <!-- Mobile Offcanvas -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Utama</a></li>
        <li class="nav-item"><a class="nav-link" href="/tentangkami">Tentang Kami</a></li>
        <li class="nav-item"><a class="nav-link" href="/KatalogUmum">Katalog</a></li>
        <li class="nav-item"><a class="nav-link" href="/hubungi-kami">Hubungi Kami</a></li>
        <li class="nav-item mt-3">
          @if(Auth::check())
            <a href="{{ route('dashboard') }}" class="btn btn-primary w-100 rounded-pill">Dashboard</a>
          @else
            <a href="{{ route('logmasuk') }}" class="btn btn-primary w-100 rounded-pill">Log Masuk</a>
          @endif
        </li>
      </ul>
    </div>
  </div>
</header>

<!-- CSS -->
<style>
 .header_section {
  background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153));
  border-bottom: 8px solid rgba(132, 11, 92, 0.995);
}

.navbar-nav .nav-link {
  color: #a113138f;
  font-weight: 700;
  font-size: 18px;
  margin-right: 20px;
  text-transform: uppercase;
  transition: color 0.3s ease;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
  color: #ffe600;
}

.btn-primary {
  background-color: #46b7da;
  border: none;
  color: black;
  font-weight: 700;
  border-radius: 30px;
  padding: 10px 25px;
  transition: background-color 0.3s ease;
}

.btn-primary:hover {
  background-color: #09fff3;
  color: black;
}

.navbar-toggler {
  border: none;
  padding: 10px;
}

.navbar-toggler-icon {
  width: 30px;
  height: 22px;
  background-size: contain;
}

.offcanvas {
  background: linear-gradient(135deg, #b42e8b 0%, #eb0c99 100%);
  color: white;
  box-shadow: 4px 0 15px rgba(0,0,0,0.3);
  border-radius: 0 15px 15px 0;
}

.offcanvas-header {
  border-bottom: 2px solid rgba(255,255,255,0.3);
  padding: 1rem 1.5rem;
}

.offcanvas-title {
  font-weight: 700;
  font-size: 1.8rem;
  color: white;
  letter-spacing: 1px;
}

.btn-close {
  filter: invert(100%);
  width: 1.5rem;
  height: 1.5rem;
}

.offcanvas-body {
  padding: 1.5rem;
}

.offcanvas-body .nav-link {
  color: rgba(255, 255, 255, 0.85);
  font-weight: 600;
  font-size: 1.1rem;
  margin-bottom: 12px;
  padding: 10px 20px;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.offcanvas-body .nav-link:hover,
.offcanvas-body .nav-link.active {
  background-color: rgba(255, 255, 255, 0.25);
  color: white !important;
  box-shadow: 0 0 8px rgba(255, 255, 255, 0.7);
  transform: translateX(5px);
}

.offcanvas-body .btn-primary {
  background-color: #46b7da;
  border-radius: 30px;
  padding: 12px 0;
  font-weight: 700;
  font-size: 1.1rem;
  width: 100%;
  transition: background-color 0.3s ease;
  color: black;
}

.offcanvas-body .btn-primary:hover {
  background-color: #09fff3;
  color: black;
  box-shadow: 0 0 10px #09fff3;
}


</style>
