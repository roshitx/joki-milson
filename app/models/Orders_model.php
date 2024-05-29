<?php

class Orders_model
{
    private $table = 'orders';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMenus()
    {
        $this->db->query("SELECT *, discount.disc AS disc,
                            (menus.price - (menus.price * discount.disc / 100)) AS discounted_price,
                            discount.start_date,
                            discount.end_date,
                            discount.disc,
                            menus.menu_id
                            FROM menus
                            LEFT JOIN discount
                            ON discount.menu_id = menus.menu_id");
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getMenuById($id)
    {
        $this->db->query("SELECT *, discount.disc AS disc,
                           (menus.price - (menus.price * discount.disc / 100)) AS discounted_price,
                           discount.start_date,
                           discount.end_date
                        FROM menus
                        LEFT JOIN discount ON discount.menu_id = menus.menu_id
                        WHERE menu_id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function addOrder($data)
    {
        $status = 'Sedang diproses';

        $query = "INSERT INTO orders (order_id, customer_name, table_number, grand_total, status) VALUES (:order_id, :customer_name, :table_number, :grand_total, :status)";
        $this->db->query($query);

        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':customer_name', $data['customer_name']);
        $this->db->bind(':table_number', $data['table_number']);
        $this->db->bind(':grand_total', $data['grand_total']);
        $this->db->bind(':status', $status);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllOrders()
    {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY order_time DESC");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getOrderDetail($orderId)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        $this->db->execute();
        return $this->db->single();
    }

    public function getMenuDetail($order_id)
    {
        $query = "SELECT orders_item.*, menus.*, discount.disc AS disc,
                           (menus.price - (menus.price * discount.disc / 100)) AS discounted_price,
                           discount.start_date,
                           discount.end_date
                    FROM orders_item
                    JOIN menus ON orders_item.menu_id = menus.menu_id
                    LEFT JOIN discount ON discount.menu_id = menus.menu_id
                    WHERE orders_item.order_id = :order_id;";

        $this->db->query($query);
        $this->db->bind(':order_id', $order_id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getTotalOrdersToday()
    {
        $this->db->query("SELECT * FROM orders WHERE DATE(order_time) = CURDATE() AND status = 'Selesai'");
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addReview($rating, $review)
    {
        $this->db->query('INSERT INTO review (rating, review) VALUES (:rating, :review)');
        $this->db->bind(':rating', $rating);
        $this->db->bind(':review', $review);
        $this->db->execute();
    }
}
