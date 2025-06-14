<!DOCTYPE html>
<html lang="ms">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="icon" href="{{ asset('images/fevicon/fevicon.png') }}" type="image/gif" />

  <!-- External Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

  <!-- Bootstrap 5 CSS (betul link) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <!-- Swiper (Testimoni Slider) CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

  <!-- Page Specific CSS -->
  @yield('css')

  <style>
    /* --- Global Styling --- */
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }

    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      background: linear-gradient(to right, rgba(169, 203, 255, 0.562), rgba(255, 255, 255, 0.541));
      flex: 1;
    }

    /* --- Header --- */
    .header_section {
      background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153));
      border-bottom: 10px solid rgba(132, 11, 92, 0.995);
    }

    /* --- Footer --- */
    footer {
      background: linear-gradient(to right, rgba(52, 3, 36, 0.995), rgb(141, 5, 91));
      color: white;
      text-align: center;
      padding: 25px 0px 0 0;
    }

    /* --- Navbar --- */
    a.nav-link {
      color: white !important;
      font-weight: bold;
      font-size: 22px;
      margin-right: 20px;
      text-transform: uppercase;
    }

    .navbar-brand img {
      height: 80px;
      margin-right: 15px;
    }

    .navbar-brand span {
      font-size: 25px;
      font-weight: bold;
      color: white;
    }

    .navbar {
      padding: 15px 20px;
    }

    /* --- Button --- */
    .btn-primary {
      background-color: #46b7da;
      color: black;
      font-size: 16px;
      font-weight: bold;
      padding: 12px 25px;
      border-radius: 30px;
      transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn-primary:hover {
      background-color: #09fff3;
      color: black;
      transform: scale(1.05);
    }
  </style>
</head>

<body>

  <div class="wrapper">
    <!-- Header -->
    <header>
        @if (session('success'))
            <div class="alert alert-success mb-0 text-center">
                <strong>{{ session('success') }}</strong>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-warning mb-0 text-center">
                <strong>{{ session('message') }}</strong>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mb-0 text-center">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif
      @include('partials.header')

    </header>

    <!-- Main Content -->
    <main>
      @yield('content')
    </main>

    <!-- Footer -->
    <footer>
      @include('partials.footer')
    </footer>
  </div>

  <!-- Core JS -->
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  <!-- Bootstrap 5 Bundle (baru tambah untuk offcanvas / hamburger) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Swiper (Slider Testimoni) JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Global js -->
   <script>
        function toggleReadMore(id) {
            const shortEl = document.getElementById(id + '_short');
            const fullEl = document.getElementById(id + '_full');

            if (shortEl.style.display === 'none') {
                shortEl.style.display = 'inline';
                fullEl.style.display = 'none';
            } else {
                shortEl.style.display = 'none';
                fullEl.style.display = 'inline';
            }
        }
    </script>

  <!-- Page Specific Scripts -->
  @yield('scripts')

</body>
</html>
