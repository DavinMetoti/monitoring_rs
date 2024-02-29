    <!-- Sidebar Start -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div>
            <div class="brand-logo d-flex align-items-center justify-content-between">
                <a href="./index.html" class="text-nowrap logo-img">
                    <img src="<?= base_url() ?>/assets/images/logo/lambangkecil.png" width="160" alt="" />
                </a>
                <div class="close-btn d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                    <i class="ti ti-x fs-8"></i>
                </div>
            </div>
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                <ul id="sidebarnav">
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Jadwal</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url() ?>admin/jadwal/monitoring" aria-expanded="false">
                            <span>
                                <i class="ti ti-heart-rate-monitor"></i>
                            </span>
                            <span class="hide-menu">Jadwal Monitoring</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url() ?>admin/jadwal/data_jadwal" aria-expanded="false">
                            <span>
                                <i class="ti ti-calendar-week"></i>
                            </span>
                            <span class="hide-menu">Jadwal Operasi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/jadwal/buat_jadwal_operasi">
                            <span>
                                <i class="ti ti-calendar-plus"></i>
                            </span>
                            <span class="hide-menu">Buat Jadwal</span>
                        </a>
                    </li>
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MASTER DATA</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/data_ruangan">
                            <span>
                                <i class="ti ti-door"></i>
                            </span>
                            <span class="hide-menu">Kamar Operasi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/data_dokter">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">Dokter Operator</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/data_dokter_anestesi">
                            <span>
                                <i class="ti ti-user-heart"></i>
                            </span>
                            <span class="hide-menu">Dokter Anestesi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/data_perlengkapan">
                            <span>
                                <i class="ti ti-tools"></i>
                            </span>
                            <span class="hide-menu">Alat Khusus</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/data_tindakan">
                            <span>
                                <i class="ti ti-wave-saw-tool"></i>
                            </span>
                            <span class="hide-menu">Tindakan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" aria-expanded="false" href="<?= base_url() ?>admin/master/daftar_admin">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Admin</span>
                        </a>
                    </li>
                    <!-- <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">EKSTENSION</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= base_url() ?>dashboard/icon" aria-expanded="false">
                            <span>
                                <i class="ti ti-mood-happy"></i>
                            </span>
                            <span class="hide-menu">Icons</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->