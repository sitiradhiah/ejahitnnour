<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                 <div class="logo">
                    <a href="{{ url('/') }}">
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
                        <span>Katalog</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('katelog.senarai') }}">Senarai</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Kategori Pakaian</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
        
