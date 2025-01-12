
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
    <style>
         .sidebar-wrapper {
            border-right: 2px solid #ddd;
            background: linear-gradient(to right,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995));
         }
        .sidebar-wrapper .menu .sidebar-link{
            color: #fff;
            i {
                color: #fff;
            }
        }
        .sidebar-wrapper .menu .sidebar-item.has-sub .sidebar-link:after {
            content: "▼" !important; /* Unicode arrow character */
            font-size: 0.8em !important; /* Adjust size if necessary */
            margin-left: 8px !important; /* Add spacing between the text and arrow */
            color: inherit !important; /* Match the text color */
        }
        .sidebar-wrapper .menu .sidebar-link:hover {
            background-color: #2b43a1;
        }
        .sidebar-wrapper .menu .submenu .submenu-item a {
            color: #fff;
        }
        .sidebar-wrapper .menu .submenu .submenu-item a:hover {
            background-color: #2b43a1;
        }
    </style>
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