<style>
  a.nav-link {
    color: white !important;
    font-weight: bold;
    font-size: 22px; /* Increased font size for better visibility */
    margin-right: 20px; /* Spacing between links */
    text-transform: uppercase; /* Make the text uppercase for consistency */
  }

  .navbar-brand img {
    height: 80px; /* Increased the logo size */
    margin-right: 15px;
  }

  .navbar-brand span {
    font-size: 25px; /* Larger font size for the brand name */
    font-weight: bold;
    color: white;
  }

  .navbar {
    padding: 15px 20px; /* Add padding for a taller header */
  }

  .btn-primary {
    background-color: #46b7da; /* Soft Pink */
    border: none;
    font-size: 16px; /* Increased font size */
    font-weight: bold;
    padding: 12px 25px; /* Increased padding for a larger button */
    border-radius: 30px;
    transition: background-color 0.3s ease, transform 0.2s;
  }

  .btn-primary:hover {
    background-color: #09fff3; /* Darker Pink on hover */
    transform: scale(1.05);
  }

  .header_section {
    background-color: #d8438e; /* Matches the footer pink theme */
    border-bottom: 3px solid #FFC0CB; /* Add a subtle border for separation */
  }
</style>

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
