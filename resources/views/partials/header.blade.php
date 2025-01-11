<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="/">
        <img class="shadow" src="{{ asset('images/logo nnour.jpg') }}" alt="Logo">
        <span>E-NourJahit</span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-white">☰</span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="/">Utama</a>
          </li>
          <li class="nav-item {{ Request::is('tentangkami') ? 'active' : '' }}">
            <a class="nav-link" href="/tentangkami">Tentang Kami</a>
          </li>
          <li class="nav-item {{ Request::is('katelog') ? 'active' : '' }}">
            <a class="nav-link" href="/katelog">Katelog</a>
          </li>
          <li class="nav-item {{ Request::is('hubungi-kami') ? 'active' : '' }}">
            <a class="nav-link" href="/hubungi-kami">Hubungi Kami</a>
          </li>
        </ul>
        <div class="ml-lg-3">
          <a href="{{ route('login') }}" class="btn btn-primary">Log Masuk</a>
        </div>
      </div>
    </nav>
  </div>
</header>
