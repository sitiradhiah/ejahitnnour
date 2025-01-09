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

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ url('index') }}">
                                {{-- <img class="shadow" src="{{ asset('images/logo nnour.jpg') }}" style="height: 60px; margin-right: 10px;"> --}}
                                <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo" style="height: 100px; width: auto; margin-right: 10px;">
                            </a>
                        </div>
                        
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
        
                        <li class="sidebar-item active ">
                            <a href="{{ url('index') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Papan Pemuka</span>
                            </a>
                        </li>
        
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Pengurusan Pendaftaran</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('component-alert') }}">Pelanggan</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('component-badge') }}">Pekerja</a>
                                </li>
                            </ul>
                        </li>
        
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Pengurusan Katalog</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('extra-component-avatar') }}">Produk</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('extra-component-sweetalert') }}">Perkhidmatan</a>
                                </li>
                            </ul>
                        </li>
        
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Pengurusan Stok</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="{{ url('layout-vertical-navbar') }}">Bahan Mentah</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ url('layout-horizontal') }}">Peralatan</a>
                                </li>
                            </ul>
                        </li>
        
                       
        
                        <li class="sidebar-item">
                            <a href="{{ url('form-layout') }}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Penjanaan Laporan</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="bi bi-arrow-left"></span>
                </button>
            </div>
        </div>
        
        
        {{-- @include('partials.sidebar') --}}
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>STATISTIK DATA KEDAI N'NOUR</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pentadbir</h6>
                                                <h6 class="font-extrabold mb-0">1</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pekerja</h6>
                                                <h6 class="font-extrabold mb-0">3</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pelanggan Berdaftar</h6>
                                                <h6 class="font-extrabold mb-0">10</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Carta Pembelian Bulanan</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-xl-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Pertanyaan Terkini</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Pertanyaan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="{{ asset('admin/images/faces/5.jpg')}}">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Orang 1</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">Ada sediakan perkhidmatan untuk cutting baju tak?</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="{{ asset('admin/images/faces/2.jpg')}}">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Orang 2</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">Boleh buat tempah untuk Baju Kurta Modern?</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('admin/images/faces/1.jpg')}}" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">WakkTailor</h5>
                                        <h6 class="text-muted mb-0">@waktailor</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Pekerja</h4>
                            </div>
                            <div class="card-content pb-4">
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="{{ asset('admin/images/faces/4.jpg')}}">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Pekerja1</h5>
                                        {{-- <h6 class="text-muted mb-0">@johnducky</h6> --}}
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="{{ asset('admin/images/faces/5.jpg')}}">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Pekerja2</h5>
                                        {{-- <h6 class="text-muted mb-0">@imdean</h6> --}}
                                    </div>
                                </div>
                                <div class="recent-message d-flex px-4 py-3">
                                    <div class="avatar avatar-lg">
                                        <img src="{{ asset('admin/images/faces/1.jpg')}}">
                                    </div>
                                    <div class="name ms-4">
                                        <h5 class="mb-1">Pekerja3</h5>
                                        {{-- <h6 class="text-muted mb-0">@dodoljohn</h6> --}}
                                    </div>
                                </div>
                                <div class="px-4">
                                    <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Pemberitahuan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Carta Pai Peratus Jantina</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; N'NOUR</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">N'NOUR</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.sidebar-link');

    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const submenu = this.nextElementSibling;

            // Toggle the submenu if it exists
            if (submenu && submenu.classList.contains('submenu')) {
                e.preventDefault(); // Prevent default action for links with submenus

                // Close all other submenus
                const allSubmenus = document.querySelectorAll('.submenu');
                allSubmenus.forEach(item => {
                    if (item !== submenu) {
                        item.classList.remove('active'); // Hide other submenus
                    }
                });

                // Toggle current submenu
                submenu.classList.toggle('active');
            }
        });
    });
});

    </script>
</body>

</html>