<?php

class Stok extends Controller
{
    // salary models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Stock Bahan';
        $data['stock'] = $this->model('Stok_model')->getAllStock();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/stock/index', $data);
        $this->view('templates/dash_footer');
    }

    public function add()
    {
        if ($this->model('Stok_model')->addStock($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new stock', 'success');
            header('Location:' . BASE_URL . '/stok');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new stock', 'error');
            header('Location:' . BASE_URL . '/stok');
            exit;
        }
    }

    public function sisa_stok()
    {
        if ($this->model('Stok_model')->addSisaStock($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new stock', 'success');
            header('Location:' . BASE_URL . '/stok');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new stock', 'error');
            header('Location:' . BASE_URL . '/stok');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Stok_model')->deleteStock($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete stok', 'success');
            header('Location:' . BASE_URL . '/stok');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete stok', 'error');
            header('Location:' . BASE_URL . '/stok');
            exit;
        }
    }

    public function getedit()
    {
        echo json_encode($this->model('Salary_model')->getSalaryById($_POST['id']));
    }

    public function update()
    {
        if ($this->model('Salary_model')->updateSalary($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully update a salary', 'success');
            header('Location:' . BASE_URL . '/salary');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed update a salary', 'error');
            header('Location:' . BASE_URL . '/salary');
            exit;
        }
    }
}
