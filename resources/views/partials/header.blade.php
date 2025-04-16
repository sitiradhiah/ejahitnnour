<!-- HTML -->
<header class="header_section">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="/">
        <img class="shadow" src="{{ asset('images/logo nnour.jpg') }}" alt="Logo">
        <span>E-NourJahit</span>
      </a>

      <!-- Hamburger Menu for Mobile -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-white">☰</span>
      </button>

      <!-- Navigation Links -->
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
</header>

<!-- CSS -->
<style>
  /* Base Styles for Navigation */
  .navbar-nav {
    display: flex;
    justify-content: space-between;
  }

  .nav-item {
    list-style-type: none;
    padding: 10px 20px;
  }

  .nav-link {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
  }

  /* Sidebar Styles (Hidden by Default) */
  .sidebar {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100%;
    background-color: #fff;
    box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    padding: 20px;
  }

  .sidebar ul {
    list-style-type: none;
    padding-left: 0;
  }

  .sidebar ul li {
    padding: 15px;
  }

  .sidebar.active {
    display: block;
  }

  /* Media Query for Mobile View */
  @media (max-width: 768px) {
    /* Hide navbar links on smaller screens */
    .navbar-nav {
      display: none;
    }

    /* Show the sidebar menu on mobile screens */
    .sidebar.active {
      display: block;
    }

    .navbar-toggler {
      display: block;
    }
  }
</style>

<!-- JavaScript (for sidebar toggle) -->
<script>
  // Hamburger Menu Toggle
  const hamburger = document.querySelector('.navbar-toggler');
  const sidebar = document.createElement('div');
  sidebar.classList.add('sidebar');
  sidebar.innerHTML = `
    <ul>
      <li><a href="/">Utama</a></li>
      <li><a href="/tentangkami">Tentang Kami</a></li>
      <li><a href="/KatalogUmum">Katalog</a></li>
      <li><a href="/hubungi-kami">Hubungi Kami</a></li>
    </ul>
  `;

  document.body.appendChild(sidebar);

  hamburger.addEventListener('click', () => {
    sidebar.classList.toggle('active');
  });
</script>
