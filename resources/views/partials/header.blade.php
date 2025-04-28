<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="/">
        <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo">
        <span>E-NourJahit</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
        <span class="navbar-toggler-icon" style="background-image: url('data:image/svg+xml;utf8,<svg viewBox=\'0 0 32 32\' xmlns=\'http://www.w3.org/2000/svg\'><path stroke=\'white\' stroke-width=\'2\' d=\'M4 8h24M4 16h24M4 24h24\'/></svg>');"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="/">Utama</a>
          </li>
          <li class="nav-item {{ Request::is('tentangkami') ? 'active' : '' }}">
            <a class="nav-link" href="/tentangkami">Tentang Kami</a>
          </li>
          <li class="nav-item {{ Request::is('KatalogUmum') ? 'active' : '' }}">
            <a class="nav-link" href="/KatalogUmum">Katalog</a>
          </li>
          <li class="nav-item {{ Request::is('hubungi-kami') ? 'active' : '' }}">
            <a class="nav-link" href="/hubungi-kami">Hubungi Kami</a>
          </li>
        </ul>
        <div class="ml-lg-3">
          @if(Auth::check())
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
          @else
            <a href="{{ route('logmasuk') }}" class="btn btn-primary">Log Masuk</a>
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
            <a href="{{ route('dashboard') }}" class="btn btn-primary w-100">Dashboard</a>
          @else
            <a href="{{ route('logmasuk') }}" class="btn btn-primary w-100">Log Masuk</a>
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
    color: #ffffff;
    font-weight: bold;
    font-size: 18px;
    margin-right: 20px;
    text-transform: uppercase;
    transition: 0.3s;
  }

  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active {
    color: #ffe600;
  }

  .btn-primary {
    background-color: #46b7da;
    border: none;
    color: black;
    font-weight: bold;
    border-radius: 30px;
    padding: 10px 25px;
    transition: 0.3s;
  }

  .btn-primary:hover {
    background-color: #09fff3;
    color: black;
  }
</style>
