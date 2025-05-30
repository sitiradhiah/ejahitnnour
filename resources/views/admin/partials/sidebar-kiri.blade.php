<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="position: sticky; top: 0; background: linear-gradient(to right,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995)); z-index: 1000;">
            <div class="d-flex justify-content-between">
                <div class="logo" style="text-align: center; width: 100%;">
                    <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo" class="shadow" style="height: 100px; width: auto; ">
                    </a>
                </div>
                <div class="toggler" style="position: absolute; right: 10px; top: 10px;">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title text-white" style="font-weight: bold; font-size: 1.2em;">MENU 
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger  ms-2">
                            Log Out
                        </button>
                    </form>
                </li>

                <li class="sidebar-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ url('admin/dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Papan Pemuka <em>(Dashboard)</em></span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('maklumat-sistem*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Maklumat Sistem</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Request::is('maklumat-sistem/senarai-pekerja') ? 'active' : '' }}">
                            <a href="{{ route('maklumat-sistem.senarai-pekerja') }}">Senarai Pekerja Kedai N'NOUR</a>
                        </li>
                        <li class="submenu-item {{ Request::is('admin/testimonial') ? 'active' : '' }}">
                            <a href="{{ route('testimonial.index') }}">Maklumat Umum</a>
                        </li>
                    </ul>
                </li>
                

                <li class="sidebar-item has-sub {{ Request::is('admin/tempahan*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Tempahan Jahitan</span>
                    </a>
                    <ul class="submenu " style="{{ Request::is('admin/tempahan*') ? 'display: block;' : '' }}">
                        <li class="submenu-item {{ Request::is('admin/tempahan/senarai') ? 'active' : '' }}">
                            <a href="{{ route('tempahan.senarai') }}">Senarai Tempahan</a>
                        </li>
                        <li class="submenu-item {{ Request::is('admin/tempahan/borang') ? 'active' : '' }}">
                            <a href="{{ route('tempahan.baru') }}">Borang Tempahan Baru</a>
                        </li>
                        <li class="submenu-item {{ Request::is('maklumat-sistem/senarai-pelanggan') ? 'active' : '' }}">
                            <a href="{{ route('pelanggan.index') }}">Senarai Pelanggan</a>
                        </li>
                        {{-- <li class="submenu-item {{ Request::is('admin/tempahan/senarai') ? 'active' : '' }}">
                            <a href="{{ route('tempahan.senarai') }}">Senarai Pelanggan Lama</a>
                        </li> --}}

                         <!-- Add "Semakan Pesanan" link here -->
                         <li class="sidebar-item {{ Request::is('admin/semakan-pesanan') ? 'active' : '' }}">
                            <a href="{{ route('semakan-pesanan.dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-search"></i>
                                <span>Semakan Pesanan</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('katalog*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Katalog Pakaian</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Request::is('katalog/senarai') ? 'active' : '' }}">
                            <a href="{{ route('katelog.senarai') }}">Senarai Pakaian</a>
                        </li>
                        <li class="submenu-item {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                            <a href="{{ route('kategori.index') }}">Kategori Pakaian</a>
                        </li>
                    </ul>
                </li>

                {{-- <li class="sidebar-item has-sub {{ Request::is('stok-bahan-mentah*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Stok Bahan Mentah</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Request::is('stok-bahan-mentah/senarai') ? 'active' : '' }}">
                            <a href="#">Senarai Bahan Jahitan</a>
                        </li>
                        <li class="submenu-item {{ Request::is('stok-bahan-mentah/kategori') ? 'active' : '' }}">
                            <a href="#">Kategori Bahan</a>
                        </li>
                    </ul>
                </li> --}}

                <li class="sidebar-item {{ Request::is('janaan-laporan*') ? 'active' : '' }}">
                    <a href="{{ route('janaan-laporan.index') }}" class="sidebar-link">
                        <i class="bi bi-stack"></i>
                        <span>Janaan Laporan</span>
                    </a>
                    {{-- <ul class="submenu ">
                        <li class="submenu-item {{ Request::is('janaan-laporan/tempahan') ? 'active' : '' }}">
                            <a href="">Tempahan</a>
                        </li>
                        <li class="submenu-item {{ Request::is('janaan-laporan/stok') ? 'active' : '' }}">
                            <a href="#">Stok</a>
                        </li>
                    </ul> --}}
                </li>

                <li class="sidebar-item {{ Request::is('aduan-cadangan*') ? 'active' : '' }}">
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
