
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PapanPemuka - Pendtadbir N'NOUR</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/images/favicon.svg') }}" type="image/x-icon">
    @yield('css')
</head>

<body>
    <div id="app">
        
        @include('../admin/partials.sidebar-kiri') 
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            @yield('content') 
            @include('../admin/partials.footer') 
        </div>

       
    </div>
    <script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>