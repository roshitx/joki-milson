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

    public function gettablebyuuid($uuid)
    {
        $data = $this->model('Table_model')->getTableByUuid($uuid);
        echo json_encode($data);
    }

    public function getNomorMeja()
    {
        $result = $this->model('Table_model')->getLastId();
        $nextId = $result['last_id'] + 1;
        echo json_encode(['nomor_meja' => $nextId]);
    }

    public function add()
    {
        if ($this->model('Table_model')->storeMeja($_POST) > 0) {
            Flasher::setFlash('Success', 'Pesanan berhasil diselesaikan', 'success');
            $order_id = $_POST['order_id'];
            header('Location:' . BASE_URL . '/table');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Gagal menyelesaikan pesanan', 'error');
            header('Location:' . BASE_URL . '/table');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Table_model')->deleteTable($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete table', 'success');
            header('Location:' . BASE_URL . '/table');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete table', 'error');
            header('Location:' . BASE_URL . '/table');
            exit;
        }
    }
}
