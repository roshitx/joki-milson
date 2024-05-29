<?php

class Cart_model
{
    private $table = 'cart';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addItemInCart($menu_id, $discounted_price)
    {
        // Cek apakah item dengan menu_id sudah ada dalam keranjang
        $query = "SELECT * FROM " . $this->table . " WHERE menu_id = :menu_id";
        $this->db->query($query);
        $this->db->bind('menu_id', $menu_id);
        $result = $this->db->single();

        if ($result) {
            // Jika item sudah ada dalam keranjang, tingkatkan quantity
            $quantity = $result['quantity'] + 1;
            $sub_total = number_format($quantity * $discounted_price, 3, '.', ',');

            $updateQuery = "UPDATE " . $this->table . " SET quantity = :quantity, sub_total = :sub_total WHERE menu_id = :menu_id";
            $this->db->query($updateQuery);
            $this->db->bind('quantity', $quantity);
            $this->db->bind('sub_total', $sub_total);
            $this->db->bind('menu_id', $menu_id);
            $this->db->execute();

            return $this->db->rowCount();
        } else {
            // Jika item belum ada dalam keranjang, tambahkan item baru dengan quantity 1
            $sub_total = $discounted_price; // Harga item pertama kali ditambahkan
            $query = "INSERT INTO " . $this->table . " (menu_id, quantity, sub_total) VALUES (:menu_id, 1, :sub_total)";
            $this->db->query($query);
            $this->db->bind('menu_id', $menu_id);
            $this->db->bind('sub_total', $sub_total);
            $this->db->execute();

            return $this->db->rowCount();
        }
    }

    public function getCartItemCount()
    {
        // Query untuk menghitung jumlah item dalam keranjang
        $query = "SELECT SUM(quantity) as total_items FROM " . $this->table;
        $this->db->query($query);
        $result = $this->db->single();

        // Mengembalikan jumlah item dalam keranjang
        return $result['total_items'] ?? 0;
    }

    public function getCart()
    {
        $query = "SELECT cart.*, menus.title, menus.price FROM cart INNER JOIN menus ON cart.menu_id = menus.menu_id";
        $this->db->query($query);
        $result = $this->db->resultSet();

        return $result;
    }

    public function deleteItemFromCart($cartId)
    {
        $query = "DELETE FROM " . $this->table . " WHERE cart_id = :cart_id";
        $this->db->query($query);
        $this->db->bind('cart_id', $cartId);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
