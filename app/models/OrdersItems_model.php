<?php

class OrdersItems_model
{
    private $table = 'orders_item';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addItemToOrder($data)
    {
        $query = "INSERT INTO $this->table (order_id, menu_id, quantity, sub_total) VALUES (:order_id, :menu_id, :quantity, :sub_total)";
        $this->db->query($query);
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':menu_id', $data['menu_id']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':sub_total', $data['sub_total']);

        return $this->db->execute();
    }

    public function getTotalItemToday()
    {
        $this->db->query("SELECT * FROM orders_item WHERE DATE(order_time) = CURDATE()");
        $this->db->execute();
        return $this->db->rowCount();
    }
}
