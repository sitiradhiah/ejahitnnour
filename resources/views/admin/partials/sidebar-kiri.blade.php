<style>
    .sidebar-wrapper .menu .sidebar-item {
        margin-top: 0 !important;
    }
    .sidebar-item {
        padding: 0px 0 !important;
    }
    .sidebar-link {
        font-size: 0.95rem !important;
    }
    ul {
        padding-left: 1rem;
    }
</style>

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="position: sticky; top: 0; background: linear-gradient(to right,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995)); z-index: 1000;">
            <div class="d-flex justify-content-between">
                <div class="logo text-center w-100">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo" class="shadow" style="height: 100px; width: auto;">
                    </a>
                </div>
                <div class="toggler position-absolute end-0 top-0 m-2">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title text-white fw-bold fs-5">MENU
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ms-2">Log Out</button>
                    </form>
                </li>

                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Papan Pemuka <em>(Dashboard)</em></span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ request()->routeIs('senarai-pekerja.index', 'testimonial.index', 'tetapan.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Maklumat Sistem</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->routeIs('senarai-pekerja.index', 'testimonial.index', 'tetapan.index') ? 'block' : 'none' }};">
                        <li class="submenu-item {{ request()->routeIs('senarai-pekerja.index') ? 'active' : '' }}">
                            <a href="{{ route('senarai-pekerja.index') }}">Senarai Pekerja Kedai N'NOUR</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('testimonial.index') ? 'active' : '' }}">
                            <a href="{{ route('testimonial.index') }}">Pengurusan Testimonial</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('tetapan.index') ? 'active' : '' }}">
                            <a href="{{ route('tetapan.index') }}">Tetapan Sistem (setting)</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ request()->routeIs('tempahan.senarai', 'tempahan.baru', 'pelanggan.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Tempahan Jahitan</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->routeIs('tempahan.senarai', 'tempahan.baru', 'pelanggan.index') ? 'block' : 'none' }};">
                        <li class="submenu-item {{ request()->routeIs('tempahan.senarai') ? 'active' : '' }}">
                            <a href="{{ route('tempahan.senarai') }}">Senarai Tempahan</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('tempahan.baru') ? 'active' : '' }}">
                            <a href="{{ route('tempahan.baru') }}">Borang Tempahan Baru</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('pelanggan.index') ? 'active' : '' }}">
                            <a href="{{ route('pelanggan.index') }}">Senarai Pelanggan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ request()->routeIs('katelog.senarai', 'kategori.index') ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Katalog Pakaian</span>
                    </a>
                    <ul class="submenu" style="display: {{ request()->routeIs('katelog.senarai', 'kategori.index') ? 'block' : 'none' }};">
                        <li class="submenu-item {{ request()->routeIs('katelog.senarai') ? 'active' : '' }}">
                            <a href="{{ route('katelog.senarai') }}">Senarai Pakaian</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
                            <a href="{{ route('kategori.index') }}">Kategori Pakaian</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ request()->routeIs('tempahan.laporan.senarai') ? 'active' : '' }}">
                    <a href="{{ route('tempahan.laporan.senarai') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Janaan Laporan</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('aduan-cadangan.index') ? 'active' : '' }}">
                    <a href="{{ route('aduan-cadangan.index') }}" class="sidebar-link">
                        <i class="bi bi-chat-dots"></i>
                        <span>Aduan & Cadangan</span>
                    </a>
                </li>
            </ul>
        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
