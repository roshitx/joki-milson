<?php

class Discount_Model
{
    private $table = 'discount';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllDiscount()
    {
        $query = "SELECT d.*, m.title, m.price FROM " . $this->table . " d JOIN menus m ON d.menu_id = m.menu_id";
        $this->db->query($query);
        $this->db->execute();
        $discounts = $this->db->resultSet();

        foreach ($discounts as &$diskon) {
            $diskon['disc'] = (int) str_replace("%", "", $diskon['disc']);
            $diskon['discounted_price'] = number_format($diskon['price'] - ($diskon['price'] * $diskon['disc'] / 100), 3, '.', ',');
        }
        return $discounts;
    }

    public function getAllMenus()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getAllCashier()
    {
        $this->db->query("SELECT * FROM users WHERE role = 'cashier'");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addDiscount($discount)
    {   
        $currentDateTime = date('Y-m-d H:i:s');

        $query = "INSERT INTO " . $this->table . " (menu_id, disc, start_date, end_date, created_at)
                  VALUES
                  (:menu_id, :disc, :start_date, :end_date, :created_at)";

        $this->db->query($query);
        $this->db->bind('menu_id', $discount['menu_id']);
        $this->db->bind('disc', $discount['disc']);
        $this->db->bind('start_date', $discount['start_date']);
        $this->db->bind('end_date', $discount['end_date']);
        $this->db->bind('created_at', $currentDateTime);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getDiskonById($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getDiscountByMenuId($menu_id)
    {
        $this->db->query("SELECT * FROM discount WHERE menu_id = :menu_id");
        $this->db->bind('menu_id', $menu_id);
        $result = $this->db->single();

        return $result;
    }

    public function updateDiscount($discount)
    {
        $query = "UPDATE " . $this->table . " SET menu_id = :menu_id, disc = :disc, start_date = :start_date, end_date = :end_date WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('menu_id', $discount['menu_id']);
        $this->db->bind('disc', $discount['disc']);
        $this->db->bind('start_date', $discount['start_date']);
        $this->db->bind('end_date', $discount['end_date']);
        $this->db->bind('id', $discount['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }


    public function deleteDiscount($id)
    {
        $diskonId = $this->getDiskonById($id);

        if ($diskonId) {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}
