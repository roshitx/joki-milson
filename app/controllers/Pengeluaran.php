<?php

class Pengeluaran extends Controller
{
    // pengeluaran models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Biaya Operasional';
        $data['pengeluaran'] = $this->model('Pengeluaran_model')->getAllPengeluaran();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/pengeluaran/index', $data);
        $this->view('templates/dash_footer');
    }

    public function add()
    {
        if ($this->model('Pengeluaran_model')->addPengeluaran($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new data', 'success');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new data', 'error');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Pengeluaran_model')->deletePengeluaran($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete data', 'success');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete data', 'error');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        }
    }

    public function getedit()
    {
        echo json_encode($this->model('Pengeluaran_model')->getPengeluaranById($_POST['id']));
    }

    public function update()
    {
        if ($this->model('Pengeluaran_model')->updatePengeluaran($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully update a data', 'success');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed update a data', 'error');
            header('Location:' . BASE_URL . '/pengeluaran');
            exit;
        }
    }
}
