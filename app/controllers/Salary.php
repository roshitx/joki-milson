<?php

class Salary extends Controller
{
    // salary models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Gaji';
        $data['salary'] = $this->model('Salary_model')->getAllSalary();
        $data['cashier'] = $this->model('Salary_model')->getAllCashier();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/salary/index', $data);
        $this->view('templates/dash_footer');
    }

    public function add()
    {
        if ($this->model('Salary_model')->addSalary($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new salary', 'success');
            header('Location:' . BASE_URL . '/salary');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new salary', 'error');
            header('Location:' . BASE_URL . '/salary');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Salary_model')->deleteSalary($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete salary', 'success');
            header('Location:' . BASE_URL . '/salary');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete salary', 'error');
            header('Location:' . BASE_URL . '/salary');
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
