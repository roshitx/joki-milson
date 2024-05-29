<?php

class Home extends Controller {
    public function index() 
    {
        $data['judul'] = 'Home';
        $data['menus'] = $this->model('Menu_model')->getSelectedMenus();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}