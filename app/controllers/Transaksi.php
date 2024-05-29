<?php

class Transaksi extends Controller
{

    public function index()
    {
        $data['judul'] = 'Milson Coffee | Semua Orderan';
        $data['order'] = $this->model('Orders_model')->getAllOrders();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/transaksi/index', $data);
        $this->view('templates/dash_footer');
    }

    public function detail($order_id)
    {
        $data['judul'] = 'Milson Coffee | Detail Orderan';
        $orderDetail = $this->model('Orders_model')->getOrderDetail($order_id);
        $detailMenu = $this->model('Orders_model')->getMenuDetail($order_id);
        $data['order_detail'] = $orderDetail;
        $data['detail_menu'] = $detailMenu;

        foreach ($data['detail_menu'] as &$menu) {
            if (
                isset($menu['discounted_price']) &&
                strtotime(date('Y-m-d')) >= strtotime($menu['start_date']) &&
                strtotime(date('Y-m-d')) <= strtotime($menu['end_date'])
            ) {
                $menu['show_discount'] = true;
            } else {
                $menu['show_discount'] = false;
            }
        }

        $this->view('templates/dash_header', $data);
        $this->view('dashboard/transaksi/detail', $data);
        $this->view('templates/dash_footer');
    }

    public function store()
    {
        if ($this->model('Transaksi_model')->addTransaksi($_POST) > 0) {
            Flasher::setFlash('Success', 'Pesanan berhasil diselesaikan', 'success');
            $order_id = $_POST['order_id'];
            header('Location:' . BASE_URL . '/transaksi/invoice/' . $order_id);
            exit;
        } else {
            Flasher::setFlash('Fail', 'Gagal menyelesaikan pesanan', 'error');
            header('Location:' . BASE_URL . '/transaksi');
            exit;
        }
    }

    public function invoice($order_id)
    {
        $data['judul'] = 'Milson Coffee | Struk Transaksi';
        $orderDetail = $this->model('Orders_model')->getOrderDetail($order_id);
        $detailMenu = $this->model('Orders_model')->getMenuDetail($order_id);
        $dataTransaksi = $this->model('Transaksi_model')->getDataById($order_id);
        $data['order_detail'] = $orderDetail;
        $data['detail_menu'] = $detailMenu;
        $data['data_transaksi'] = $dataTransaksi;

        foreach ($data['detail_menu'] as &$menu) {
            if (
                isset($menu['discounted_price']) &&
                strtotime(date('Y-m-d')) >= strtotime($menu['start_date']) &&
                strtotime(date('Y-m-d')) <= strtotime($menu['end_date'])
            ) {
                $menu['show_discount'] = true;
            } else {
                $menu['show_discount'] = false;
            }
        }

        $this->view('dashboard/transaksi/invoice', $data);
    }

    public function getMonthlyProfit()
    {
        // Data awal berisi semua bulan dengan total pendapatan awalnya adalah 0
        $monthlyProfitData = [
            ["bulan" => "Januari", "total_pendapatan" => 0],
            ["bulan" => "Februari", "total_pendapatan" => 0],
            ["bulan" => "Maret", "total_pendapatan" => 0],
            ["bulan" => "April", "total_pendapatan" => 0],
            ["bulan" => "Mei", "total_pendapatan" => 0],
            ["bulan" => "Juni", "total_pendapatan" => 0],
            ["bulan" => "Juli", "total_pendapatan" => 0],
            ["bulan" => "Agustus", "total_pendapatan" => 0],
            ["bulan" => "September", "total_pendapatan" => 0],
            ["bulan" => "Oktober", "total_pendapatan" => 0],
            ["bulan" => "November", "total_pendapatan" => 0],
            ["bulan" => "Desember", "total_pendapatan" => 0]
        ];
        
        $result = $this->model('Transaksi_model')->getMonthlyProfit();
        foreach ($result as $row) {
            $bulan = $row['bulan'];
            $totalPendapatan = $row['total_pendapatan'];
            $monthlyProfitData[$bulan - 1]["total_pendapatan"] = $totalPendapatan;
        }
    
        echo json_encode($monthlyProfitData);
    }

    public function getMonthlySoldItemByCategory()
    {
        $result = $this->model('Transaksi_model')->getMonthlySoldItemByCategory();
        echo json_encode($result);
    }
}
