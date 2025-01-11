
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Update the counter for the specific table
            setInterval(() => {
                updateTotalCount('/api/count/users', 'totalItems');
            }, 5000); // Refresh every 5 seconds

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