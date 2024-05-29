<?php

class Menu extends Controller
{
    // menu models
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Data Menu';
        $data['menu'] = $this->model('Menu_model')->getAllMenus();
        foreach ($data['menu'] as &$menu) {
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
        $this->view('dashboard/menus/index', $data);
        $this->view('templates/dash_footer');
    }

    public function add()
    {
        if (empty($_FILES["image"]["name"])) {
            // Gambar tidak diunggah
            Flasher::setFlash('Fail', 'Please upload an image', 'error');
            header('Location:' . BASE_URL . '/menu');
            exit;
        }

        if ($this->model('Menu_model')->addMenu($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully added new menu', 'success');
            header('Location:' . BASE_URL . '/menu');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed added new menu', 'error');
            header('Location:' . BASE_URL . '/menu');
            exit;
        }
    }

    public function delete($id)
    {
        if ($this->model('Menu_model')->deleteMenu($id) > 0) {
            Flasher::setFlash('Success', 'Successfully delete menu', 'success');
            header('Location:' . BASE_URL . '/menu');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed delete menu', 'error');
            header('Location:' . BASE_URL . '/menu');
            exit;
        }
    }

    public function getedit()
    {
        echo json_encode($this->model('Menu_model')->getMenuById($_POST['id']));
    }

    public function update()
    {
        if ($this->model('Menu_model')->updateMenu($_POST) > 0) {
            Flasher::setFlash('Success', 'Successfully update a menu', 'success');
            header('Location:' . BASE_URL . '/menu');
            exit;
        } else {
            Flasher::setFlash('Fail', 'Failed update a menu', 'error');
            header('Location:' . BASE_URL . '/menu');
            exit;
        }
    }
}
