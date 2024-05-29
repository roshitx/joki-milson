<?php

class Discount extends Controller
{
    // discount models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Diskon';
        $data['discount'] = $this->model('Discount_model')->getAllDiscount();

        $this->view('templates/dash_header', $data);
        $this->view('dashboard/diskon/index', $data);
        $this->view('templates/dash_footer');
    }

    public function create()
    {
        $data['judul'] = 'Milson Coffee | Data Diskon';
        // Ambil data menu dari model
        $data['menus'] = $this->model('Menu_model')->getAllMenusWithoutDiscount();

        // Tampilkan view dengan data menu
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/diskon/create', $data);
        $this->view('templates/dash_footer');
    }

    public function store()
    {
        if ($this->model('Discount_model')->addDiscount($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new discount', 'success');
            header('Location:' . BASE_URL . '/discount');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new discount', 'error');
            header('Location:' . BASE_URL . '/discount');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Discount_model')->deleteDiscount($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete discount', 'success');
            header('Location:' . BASE_URL . '/discount');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete discount', 'error');
            header('Location:' . BASE_URL . '/discount');
            exit;
        }
    }

    public function getMenuPrice($menu_id)
    {
        $menu = $this->model('Menu_model')->getMenuById($menu_id);
        echo json_encode(['price' => $menu['price']]); // Send price as JSON
    }
}
