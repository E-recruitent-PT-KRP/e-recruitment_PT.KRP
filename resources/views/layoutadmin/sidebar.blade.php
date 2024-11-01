<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <img src="{{ asset('sneat/assets/img/coba.png') }}" alt="Logo" width="200"
            style="padding-top: 5px; padding-bottom: 5px;">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Route::is('admin.dashboard') ? 'active open' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        <li class="menu-item {{ Route::is('career.*') ? 'active' : '' }}">
            <a href="{{ route('career.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-network-chart"></i>
                <div data-i18n="Account Settings">Manage Lowongan Pekerjaan</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('pendaftar.index') ? 'active' : '' }}">
            <a href="{{ route('pendaftar.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-network-chart"></i>
                <div data-i18n="Account Settings">Manage Data Pelamar</div>
            </a>
        </li>
        <li class="menu-item {{ Route::is('data-diterima.*') || Route::is('data-ditolak.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-x"></i>
                <div>Arsip E-recruitemnt</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('arsip.data-diterima') ? 'active' : '' }}">
                    <a href="{{ route('arsip.data-diterima') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-network-chart"></i>
                        <div data-i18n="Account Settings">Data Diterima</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('arsip.data-ditolak') ? 'active' : '' }}">
                    <a href="{{ route('arsip.data-ditolak') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-block"></i>
                        <div data-i18n="Account Settings">Data Ditolak</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-item {{ Route::is('data-gallery.*') || Route::is('data-company.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-x"></i>
                <div>Pengaturan Gallery dan Company</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::is('gallery.index') ? 'active' : '' }}">
                    <a href="{{ route('gallery.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-network-chart"></i>
                        <div data-i18n="Account Settings">Data Gallery</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::is('arsip.data-ditolak') ? 'active' : '' }}">
                    <a href="{{ route('arsip.data-ditolak') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-block"></i>
                        <div data-i18n="Account Settings">Data Ditolak</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>