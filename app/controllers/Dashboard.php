<?php

class Dashboard extends Controller {
    public function index() 
    {
        $data['judul'] = 'Milson Coffee | Dashboard';
        $data['total_cashier'] = $this->model('User_model')->getAllCashier();
        $data['total_menu'] = $this->model('Menu_model')->getAllMenus();
        $data['total_orders_today'] = $this->model('Orders_model')->getTotalOrdersToday();
        $data['total_item_sold'] = $this->model('OrdersItems_model')->getTotalItemToday();
        $this->view('templates/dash_header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/dash_footer');
    }
}