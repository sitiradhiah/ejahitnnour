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
  @yield('css')
  <style>
   /* Make the entire page fill the viewport height */
    .page-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Allow the content to grow and push the footer down */
    .content {
        flex: 1;
    }

    /* Ensure the footer spans the full width */
    footer {
        background-color: rgb(255, 87, 193);
        padding: 20px 10px;
        color: white;
        text-align: center;
    }
  </style>
</head>
<body>
    <!-- Header -->
    @include('partials.header')

    <main style="background: linear-gradient(to right, rgba(169, 203, 255, 0.562), rgba(255, 255, 255, 0.541));">
      @yield('content')
    </main>
  
    @include('partials.footer')
  

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