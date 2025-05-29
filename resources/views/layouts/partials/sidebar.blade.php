<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div ">
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item mt-3">
                    <a href="{{ route('dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Metode WP</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kriteria.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span class="pcoded-mtext">Kriteria</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sub-kriteria.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span class="pcoded-mtext">Sub
                            Kriteria</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('perhitungan.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-edit-2"></i></span><span class="pcoded-mtext">Perhitungan</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Kelola Data</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('masyarakat.index') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-users"></i></span><span class="pcoded-mtext">Masyarakat</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
