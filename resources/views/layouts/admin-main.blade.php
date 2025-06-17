@php
use Illuminate\Support\Facades\Auth;
    if (Auth::check() && (Auth::user()->status !== 'aktif' || Auth::user()->disahkan != 1)) {
        header('Location: ' . url('/'));
        exit();
    }
@endphp
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
                font-size: 0.9rem;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
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

    <style>
        .page-heading {
            margin-bottom: 20px !important;
            text-align: center !important;
            h3 {
                text-transform: uppercase !important;
            }
        }
        .table th, .table td {
            padding: 0.35rem !important;
            /* font-size: 0.92rem !important; */
        }
        .table {
            font-size: 0.9rem !important;
        }
        .table thead th {
            background-color: #343a40 !important;
            color: #fff !important;
        }
        .card, .card-header {
            background: whitesmoke;
        }
        #main {
            background: #e1e1e1 !important;
        }
    </style>
    <style>
        .styled-table {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            overflow: hidden;
        }

        .styled-table th {
            background-color: #f1f1f1;
            font-weight: 600;
            vertical-align: middle;
            padding: 0.5rem 0.75rem;
            border: 1px solid #dee2e6;
            width: 30%;
        }

        .styled-table td {
            background-color: #fafafa;
            padding: 0.5rem 0.75rem;
            border: 1px solid #dee2e6;
        }
    </style>
    @yield('css')
</head>

<body>
    <div id="app">
        <!-- Header displaying user name and email -->
        <div class="container-fluid py-3 px-4" style="background: linear-gradient(to left,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995)); border-bottom: 1px solid #ddd;">
            @if(Auth::check())
                <div class="d-flex justify-content-end align-items-center" style="color: #fff;">
                    <span class="me-3">
                        <strong style="color: #fff; text-transform: Capitalize;">
                            Nama {{ Auth::user()->peranan }} :
                        </strong>
                        <strong style="color: #fff;">{{ Auth::user()->name }}</strong>
                        <small class="text-muted" style="color: #fff !important;">({{ Auth::user()->email }})</small>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light" style="color: #b40a76; font-weight: bold;">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            @endif
        </div>
        @include('../admin/partials.sidebar-kiri')

        @if(session('message'))
            <div class="alert alert-success m-1 text-end">{{ session('message') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success m-1 text-end">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger m-1 text-end">{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger m-1 text-end">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif

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
    <!-- Global Table Pagination JS -->
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        function paginateTable(table) {
            const perPage = parseInt(table.getAttribute('data-per-page')) || 10;
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const total = rows.length;
            const totalPages = Math.ceil(total / perPage);
            const paginationId = table.getAttribute('data-pagination-id');
            const paginationContainer = document.getElementById(paginationId);

            if (!paginationContainer) return;

            function showPage(page) {
                const start = (page - 1) * perPage;
                const end = start + perPage;
                rows.forEach((row, i) => {
                    row.style.display = (i >= start && i < end) ? '' : 'none';
                });
            }

            function renderPagination() {
                paginationContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (i === 1 ? ' active' : '');
                    const a = document.createElement('a');
                    a.className = 'page-link';
                    a.href = '#';
                    a.textContent = i;
                    a.addEventListener('click', function (e) {
                        e.preventDefault();
                        paginationContainer.querySelectorAll('.page-item').forEach(item => item.classList.remove('active'));
                        li.classList.add('active');
                        showPage(i);
                    });
                    li.appendChild(a);
                    paginationContainer.appendChild(li);
                }
            }

            if (totalPages > 1) renderPagination();
            showPage(1);
        }

        document.querySelectorAll('.paginated-table').forEach(paginateTable);
    });
    </script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrappers = document.querySelectorAll('.scroll-wrapper');

        wrappers.forEach(wrapper => {
            const topScroll = wrapper.querySelector('.scroll-sync-top');
            const bottomScroll = wrapper.querySelector('.scroll-sync-bottom');
            const table = bottomScroll.querySelector('table');
            if (!table) return;

            const dummyDiv = document.createElement('div');
            dummyDiv.style.width = table.scrollWidth + 'px';
            dummyDiv.style.height = '1px';
            topScroll.appendChild(dummyDiv);

            topScroll.classList.add('scroll-sync-container');
            bottomScroll.classList.add('scroll-sync-container');

            topScroll.onscroll = () => bottomScroll.scrollLeft = topScroll.scrollLeft;
            bottomScroll.onscroll = () => topScroll.scrollLeft = bottomScroll.scrollLeft;
        });
    });
</script>

<style>
.scroll-wrapper {
    display: flex;
    flex-direction: column;
}
.scroll-sync-container {
    overflow-x: auto;
    white-space: nowrap;
}
.scroll-sync-top {
    margin-bottom: 4px;
}
</style>

</body>

</html>
