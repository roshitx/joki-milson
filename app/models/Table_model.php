<?php

class Table_model
{
    private $table = "table";
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllTable()
    {
        $this->db->query("SELECT * FROM `" . $this->table . "`");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getLastId()
    {
        $this->db->query("SELECT MAX(id) AS last_id FROM `" . $this->table . "`");
        $this->db->execute();
        return $this->db->single();
    }
    public function addTable($data)
    {
        $transactionId = 'TRN-' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 7);

        $query = "INSERT INTO transactions (transaction_id, order_id, payment_method, total_amount, cashier_name) VALUES (:transaction_id, :order_id, :payment_method, :total_amount, :cashier_name)";
        $this->db->query($query);

        $this->db->bind(':transaction_id', $transactionId);
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':cashier_name', $data['cashier_name']);

        $this->db->execute();
        
        $this->db->query("UPDATE orders SET status = :status WHERE order_id = :order_id");
        $this->db->bind(':order_id', $data['order_id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getDataById($orderId)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE order_id = :order_id";
        $this->db->query($query);
        $this->db->bind(':order_id', $orderId);
        $this->db->execute();
        return $this->db->single();
    }

    public function getMonthlyProfit()
    {
        // Ambil data pendapatan yang ada dari database
        $query = "SELECT MONTH(transaction_date) AS bulan, SUM(total_amount) AS total_pendapatan FROM transactions
                  WHERE YEAR(transaction_date) = YEAR(CURRENT_DATE())
                  GROUP BY bulan";

        $this->db->query($query);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getMonthlySoldItemByCategory()
    {
        $query = "
        SELECT 
            m.kategori,
            SUM(oi.quantity) AS total_penjualan
        FROM orders_item oi
        JOIN menus m ON oi.menu_id = m.menu_id
        GROUP BY m.kategori
    ";

        $this->db->query($query);
        $this->db->execute();
        $result = $this->db->resultSet();

        $pieChartData = [];

        foreach ($result as $row) {
            $kategori = $row['kategori'];
            $totalPenjualan = $row['total_penjualan'];

            $pieChartData[] = [
                'kategori' => $kategori,
                'total_penjualan' => $totalPenjualan,
            ];
        }

        return $pieChartData;
    }
}
