<?php

class Laporan_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function laporanKeuangan()
    {
        $this->db->query("SELECT
        DATE(transaction_date) as transaction_date,
        SUM(total_amount) AS total_amount
        FROM
        transactions
        GROUP BY
        DATE(transaction_date)
        ORDER BY
        DATE(transaction_date) ASC");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanPenjualan()
    {
        $this->db->query("SELECT DATE(transactions.transaction_date) as transaction_date, menus.title, SUM(orders_item.quantity) as quantity_sold, SUM(orders_item.quantity * menus.price) as total_sales
        FROM transactions
        JOIN orders ON transactions.order_id = orders.order_id
        JOIN orders_item ON orders.order_id = orders_item.order_id
        JOIN menus ON orders_item.menu_id = menus.menu_id
        GROUP BY DATE(transactions.transaction_date), menus.title
        ORDER BY DATE(transactions.transaction_date) DESC, quantity_sold DESC");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanDiskonPromo()
    {
        $query = "SELECT d.menu_id, m.title, m.price, MAX(d.disc) AS disc, 
                  (m.price - (m.price * MAX(d.disc) / 100)) AS discounted_price,
                  (m.price * MAX(d.disc) / 100) AS discount_amount,
                  COUNT(t.transaction_id) AS usage_count
                  FROM discount d
                  JOIN menus m ON d.menu_id = m.menu_id
                  LEFT JOIN orders_item oi ON d.menu_id = oi.menu_id
                  JOIN transactions t ON oi.order_id = t.order_id
                  GROUP BY d.menu_id, m.title, m.price";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanOmset($startDate = null, $endDate = null)
    {
        $query = "SELECT DATE(t.transaction_date) AS transaction_date, SUM(t.total_amount) AS total_omset
                  FROM transactions t";
    
        if ($startDate !== null && $endDate !== null) {
            $query .= " WHERE t.transaction_date BETWEEN :start_date AND :end_date";
        }
    
        $query .= " GROUP BY DATE(t.transaction_date)";
    
        if ($startDate !== null && $endDate !== null) {
            $this->db->query($query);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        } else {
            $this->db->query($query);
        }
    
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanReview()
    {
        $query = "SELECT * FROM review ORDER BY created_at DESC";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanPengeluaran($startDate = null, $endDate = null)
    {
        $query = "SELECT * FROM pengeluaran";
        
        if ($startDate !== null && $endDate !== null) {
            $query .= " WHERE date BETWEEN :start_date AND :end_date";
            $this->db->query($query);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        } else {
            $this->db->query($query);
        }
    
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanStok($startDate = null, $endDate = null)
    {
        $query = "SELECT * FROM stok";
        
        if ($startDate !== null && $endDate !== null) {
            $query .= " WHERE tanggal BETWEEN :start_date AND :end_date";
            $this->db->query($query);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        } else {
            $this->db->query($query);
        }
    
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function laporanPendapatan($startDate = null, $endDate = null)
    {
        $query1 = "SELECT SUM(total_amount) AS total_amount FROM transactions";
        $query2 = "SELECT SUM(amount) AS total_pengeluaran FROM pengeluaran";
    
        if ($startDate !== null && $endDate !== null) {
            $query1 .= " WHERE transaction_date BETWEEN :start_date AND :end_date";
            $query2 .= " WHERE date BETWEEN :start_date AND :end_date";
        }
    
        $this->db->query($query1);
        if ($startDate !== null && $endDate !== null) {
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        }
        $this->db->execute();
        $total_amount = $this->db->single();
    
        $this->db->query($query2);
        if ($startDate !== null && $endDate !== null) {
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
        }
        $this->db->execute();
        $total_pengeluaran = $this->db->single();
    
        return [
            'total_amount' => $total_amount['total_amount'],
            'total_pengeluaran' => $total_pengeluaran['total_pengeluaran']
        ];
    }
}
