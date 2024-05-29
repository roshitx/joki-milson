<?php

class Table extends Controller
{

    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Master Meja';
        $data['table'] = $this->model('Table_model')->getAllTable();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/table/index', $data);
        $this->view('templates/dash_footer');
    }

    public function getNomorMeja()
    {
        $result = $this->model('Table_model')->getLastId();
        $nextId = $result['last_id'] + 1;
        echo json_encode(['nomor_meja' => $nextId]);
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
}
