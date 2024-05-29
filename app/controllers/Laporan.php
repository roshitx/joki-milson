<?php

class Laporan extends Controller
{
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Dashboard';
        $data['total_cashier'] = $this->model('User_model')->getAllCashier();
        $data['total_menu'] = $this->model('Menu_model')->getAllMenus();
        $data['total_orders_today'] = $this->model('Orders_model')->getTotalOrdersToday();
        $data['total_item_sold'] = $this->model('OrdersItems_model')->getTotalItemToday();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/dash_footer');
    }

    public function keuangan()
    {
        $data['judul'] = 'Milson Coffee | Laporan Keuangan';
        $data['uang_masuk'] = $this->model('Laporan_model')->laporanKeuangan();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_keuangan', $data);
        $this->view('templates/dash_footer');
    }

    public function penjualan()
    {
        $data['judul'] = 'Milson Coffee | Laporan Penjualan Produk';
        $data['produk'] = $this->model('Laporan_model')->laporanPenjualan();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_penjualan', $data);
        $this->view('templates/dash_footer');
    }

    public function diskon()
    {
        $data['judul'] = 'Milson Coffee | Laporan Diskon & Promo';
        $data['diskon_promo'] = $this->model('Laporan_model')->laporanDiskonPromo();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_diskon', $data);
        $this->view('templates/dash_footer');
    }

    public function omset()
    {
        $data['judul'] = 'Milson Coffee | Laporan Omset Penjualan';
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $data['omset'] = $this->model('Laporan_model')->laporanOmset($startDate, $endDate);
        } else {
            $data['omset'] = $this->model('Laporan_model')->laporanOmset();
        }
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_omset', $data);
        $this->view('templates/dash_footer');
    }

    public function rating()
    {
        $data['judul'] = 'Milson Coffee | Laporan Rating & Review Pelanggan';
        $data['review'] = $this->model('Laporan_model')->laporanReview();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_review', $data);
        $this->view('templates/dash_footer');
    }

    public function operasional()
    {
        $data['judul'] = 'Milson Coffee | Laporan Biaya Operasional & Pengeluaran';
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $data['pengeluaran'] = $this->model('Laporan_model')->laporanPengeluaran($startDate, $endDate);
            $data['omset_penjualan'] = $this->model('Laporan_model')->laporanPendapatan($startDate, $endDate);
        } else {
            $data['pengeluaran'] = $this->model('Laporan_model')->laporanPengeluaran();
            $data['omset_penjualan'] = $this->model('Laporan_model')->laporanPendapatan();
        }
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_operasional', $data);
        $this->view('templates/dash_footer');
    }

    public function stok()
    {
        $data['judul'] = 'Milson Coffee | Laporan Stok Bahan';
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];
            $data['stok'] = $this->model('Laporan_model')->laporanStok($startDate, $endDate);
        } else {
            $data['stok'] = $this->model('Laporan_model')->laporanStok();
        }
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/laporan/laporan_stok', $data);
        $this->view('templates/dash_footer');
    }
}
