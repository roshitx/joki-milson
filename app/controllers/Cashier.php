<?php

class Cashier extends Controller
{
    // cashier models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Cashier';
        $data['cashier'] = $this->model('User_model')->getAllCashier();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/users/index', $data);
        $this->view('templates/dash_footer');
    }

    public function add()
    {
        if ($this->model('User_model')->addCashier($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new cashier', 'success');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new cashier', 'error');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('User_model')->deleteCashier($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete cashier', 'success');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete cashier', 'error');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        }
    }

    public function getedit()
    {
        echo json_encode($this->model('User_model')->getCashierById($_POST['id']));
    }

    public function update()
    {
        if ($this->model('User_model')->updateCashier($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully update a cashier', 'success');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed update a cashier', 'error');
            header('Location:' . BASE_URL . '/cashier');
            exit;
        }
    }
}
