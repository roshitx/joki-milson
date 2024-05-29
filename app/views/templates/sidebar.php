    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL ?>/dashboard">
            <div class="sidebar-brand-icon">
                <img src="<?= BASE_URL ?>/img/dashboard/logo-milson-white.png" alt="Logo Milson Coffee" width="40">
            </div>
            <div class="sidebar-brand-text mx-3">Milson <sup>Dash</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" id="dashboardLink">
            <a class="nav-link" href="<?= BASE_URL ?>/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Kasir
        </div>

        <li class="nav-item" id="transaksiLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true"
                aria-controls="transaksi">
                <i class="fa-solid fa-dollar-sign"></i>
                <span>Transaksi</span>
            </a>
            <div id="transaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Transaksi</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/transaksi">List Transaksi</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="pengeluaranLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengeluaran" aria-expanded="true"
                aria-controls="pengeluran">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Pengeluaran</span>
            </a>
            <div id="pengeluaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Biaya Pengeluaran</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/pengeluaran">List Pengeluaran</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="stokLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stok" aria-expanded="true"
                aria-controls="stok">
                <i class="fa-solid fa-box"></i>
                <span>Stok Bahan</span>
            </a>
            <div id="stok" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Stok Bahan</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/stok">List Stok Bahan</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="laporanLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
                aria-controls="laporan">
                <i class="fa-solid fa-note-sticky"></i>
                <span>Laporan</span>
            </a>
            <div id="laporan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Laporan</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/keuangan">Laporan Keuangan</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/penjualan">Laporan Penjualan Produk</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/diskon">Laporan Diskon & Promo</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/omset">Laporan Omset Penjualan</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/rating">Kepuasan Pelanggan</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/operasional">Laporan Biaya Operasional</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/laporan/stok">Laporan Stok Bahan</a>
                </div>
            </div>
        </li>

        <?php 
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        ?>
        <div class="sidebar-heading">
            Administrator
        </div>

        <li class="nav-item" id="menuLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu" aria-expanded="true"
                aria-controls="menu">
                <i class="fa-solid fa-bowl-food"></i>
                <span>Menu</span>
            </a>
            <div id="menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Menu</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/menu">List Menu</a>
                    <a class="collapse-item" href="<?= BASE_URL ?>/discount">Diskon Menu</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="cashierLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cashier" aria-expanded="true"
                aria-controls="cashier">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Kasir</span>
            </a>
            <div id="cashier" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Kasir</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/cashier">List Kasir</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="gajiLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gaji" aria-expanded="true"
                aria-controls="cashier">
                <i class="fa-solid fa-sack-dollar"></i>
                <span>Gaji</span>
            </a>
            <div id="gaji" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Gaji</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/salary">List Gaji</a>
                </div>
            </div>
        </li>

        <li class="nav-item" id="mejaLink">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#meja" aria-expanded="true"
                aria-controls="meja">
                <i class="fa-solid fa-chair"></i>
                <span>Data Meja</span>
            </a>
            <div id="meja" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelola Meja</h6>
                    <a class="collapse-item" href="<?= BASE_URL ?>/table">Data Master Meja</a>
                </div>
            </div>
        </li>
        <?php
            }
        ?>
    </ul>
    <!-- End of Sidebar -->