<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header" style="position: sticky; top: 0; background: linear-gradient(to right,  rgb(180, 10, 118), rgba(125, 10, 87, 0.995)); z-index: 1000;">
            <div class="d-flex justify-content-between">
                <div class="logo" style="text-align: center; width: 100%;">
                    <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo nnour.jpg') }}" alt="Logo" style="height: 100px; width: auto; margin-right: 10px;">
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

                <li class="sidebar-item active">
                    <a href="{{ url('index') }}" class='sidebar-link'>
                        <i class="bi bi-bar-chart-fill"></i>
                        <span>Papan Pemuka <em>(Dashboard)</em></span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Pendaftaran Pekerja</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Tempahan Jahitan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('katelog.senarai') }}">Senarai</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Kategori</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Katalog Pakaian</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('katelog.senarai') }}">Senarai</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Kategori</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Stok Bahan Mentah</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="">Senarai</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Kategori Pakaian</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Janaan Laporan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="">Tempahan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Stok</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Aduan dan Cadangan Orang Awam</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="">Tempahan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Stok</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
        
