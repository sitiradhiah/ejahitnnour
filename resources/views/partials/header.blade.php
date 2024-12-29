  <!-- header section strats -->
  <header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.html">
          <span>
            HandTime
          </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Utama <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('tentangkami') ? 'active' : '' }}">
                    <a class="nav-link" href="/tentangkami">Tentang Kami</a>
                </li>
                <li class="nav-item {{ Request::is('katelog') ? 'active' : '' }}">
                    <a class="nav-link" href="/katelog">Katelog</a>
                </li>
                <li class="nav-item {{ Request::is('testimonial') ? 'active' : '' }}">
                    <a class="nav-link" href="/testimonial">Testimonial</a>
                </li>
                <li class="nav-item {{ Request::is('hubungi-kami') ? 'active' : '' }}">
                    <a class="nav-link" href="/hubungi-kami">Hubungi Kami</a>
                </li>
            </ul>
            <div>
                <a href="" class="btn btn-primary">
                    Log Masuk
                </a>
            </div>
        </div>
      </nav>
    </div>
  </header>
  <!-- end header section -->