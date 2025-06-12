<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ruang Pentadbir N\'NOUR')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/images/favicon.svg') }}" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" referrerpolicy="no-referrer" />


    <style>
         .sidebar-wrapper {
            border-right: 2px solid #ddd;
            background: linear-gradient(to right,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995));
            width:260px;
         }
         #main {
            margin-left: 263px;
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
        .sidebar-wrapper .menu .submenu .submenu-item.active>a {
            color: #34d8f8;
            font-weight: 800;
            text-decoration: underline;
        }
        /* Ensure the column stays in place */
        .sticky-col {
            position: sticky;
            z-index: 2;
        }

        /* Stick the last column to the right */
        .sticky-right {
            right: 0;
        }

        /* Optional: Keep header above body content */
        thead th {
            /* background: #f8f9fa !important; or any color */
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .tindakan-bg {
            background-color:rgb(207, 193, 203) !important;
            color:black !important;
        }
        /* custom dropdown */
            /* Reusable dropdown style */
            .dropdown-status {
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                padding-right: 2rem; /* space for chevron */
                white-space: normal;
                word-break: break-word;
                overflow-wrap: break-word;
                width: 100%;
            }

            /* Chevron icon position inside the wrapper */
            .dropdown-wrapper {
                position: relative;
                display: inline-block;
                width: 100%;
            }

            .dropdown-wrapper .dropdown-icon {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                pointer-events: none;
                color: #666;
            }
        /* end custom */
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

    <!-- Scripts for Bootstrap Modal and other features -->
    <script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>

    <!-- Bootstrap modal JS -->
    <!-- Ensure that Bootstrap's JavaScript is included -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>

</html>
