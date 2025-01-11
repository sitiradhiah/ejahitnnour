<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />



  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
  <!-- responsive style -->
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>

    /* Reset body margin and height */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    /* Flexbox for wrapper */
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Main content grows */
    main {
        background: linear-gradient(to right, rgba(169, 203, 255, 0.562), rgba(255, 255, 255, 0.541));
        flex: 1;
        /* padding: 20px; */
    }

    .header_section {
      background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153)); 
      border-bottom: 10px solid rgba(132, 11, 92, 0.995);
    }
    /* Footer styling */
    footer {
        background: linear-gradient(to right, rgba(52, 3, 36, 0.995), rgb(141, 5, 91));
        /* border-top: 5px solid rgba(0, 0, 0, 0.995); */
        color: white;
        text-align: center;
        padding: 25px 0px 0 0;
    }

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
      /* border: none; */
      color: black; /* Black text color */
      font-size: 16px; /* Increased font size */
      font-weight: bold;
      padding: 12px 25px; /* Increased padding for a larger button */
      border-radius: 30px;
      transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn-primary:hover {
      background-color: #09fff3; /* Darker Pink on hover */
      color: black; /* Black text color */
      transform: scale(1.05);
    }
  </style>
  @yield('css')
  
</head>
<body>
  
  <div class="wrapper">
    <header>
        @include('partials.header')
    </header>

    <main>
      @yield('content')
    </main>
  
    <footer>
      @include('partials.footer')
    </footer>
  </div>

  <!-- jQery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script type="text/javascript" src="js/custom.js"></script>
  <!-- Google Map -->
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script> --}}
  <!-- End Google Map -->
</body>
</html>