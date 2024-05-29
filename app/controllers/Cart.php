<?php

class Cart extends Controller
{
    public function index()
    {
        $data['judul'] = 'Milson Coffee | Semua Menu';
        $data['menus'] = $this->model('Orders_model')->getAllMenus();
        $this->view('templates/header', $data);
        $this->view('home/menus/index', $data);
        $this->view('templates/footer');
    }

    public function detail()
    {
        $data['cart'] = $this->model('Cart_model')->getCart(); // Mengambil data keranjang
        $cartItemCount = $this->model('Cart_model')->getCartItemCount();
        $_SESSION['cart_item_count'] = $cartItemCount;
        echo json_encode($data);
    }

    public function add()
    {
        $menu_id = $_POST['menu_id'];
        $menuItem = $this->model('Menu_model')->getMenuById($menu_id);
        var_dump($menuItem);
    
        // Cari diskon
        $discount = $this->model('Discount_model')->getDiscountByMenuId($menu_id);
    
        // Jika ada diskon, hitung harga diskon
        if ($discount) {
            $discounted_price = $menuItem['price'] - ($menuItem['price'] * $discount['disc'] / 100);
            $discounted_price = number_format($discounted_price, 3, '.', ',');
        } else {
            $discounted_price = $menuItem['price'];
        }
    
        // Tambah item ke cart
        $this->model('Cart_model')->addItemInCart($menu_id, $discounted_price);
    
        // Perbarui jumlah item di cart
        $cartItemCount = $this->model('Cart_model')->getCartItemCount();
        $_SESSION['cart_item_count'] = $cartItemCount;
    
        // Redirect ke halaman orders
        header('Location:' . BASE_URL . '/orders');
        exit;
    }

    public function delete($cartId)
    {
        if ($this->model('Cart_model')->deleteItemFromCart($cartId) > 0) {
            $cartItemCount = $this->model('Cart_model')->getCartItemCount();
            $_SESSION['cart_item_count'] = $cartItemCount;
        } else {
            // Redirect atau tampilkan pesan kesalahan
        }
    }
}