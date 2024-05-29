<?php

class Stok_model
{
    private $table = 'stok';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllStock()
    {
        $this->db->query("SELECT * FROM " . $this->table);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addStock($stock)
    {
        $currentDateTime = date('Y-m-d H:i:s');
    
        $query = "INSERT INTO " . $this->table . " (nama_item, satuan, type, tanggal)
                  VALUES
                  (:nama_item, :satuan, :type, :tanggal)";
    
        $this->db->query($query);
        $this->db->bind('nama_item', $stock['nama_item']);
        $this->db->bind('satuan', $stock['satuan']);
        $this->db->bind('type', $stock['type']);
        $this->db->bind('tanggal', $stock['tanggal']);
        $this->db->execute();
    
        return $this->db->rowCount();
    }

    public function addSisaStock($stock)
    {
        $currentDateTime = date('Y-m-d H:i:s');
    
        $query = "UPDATE stok SET sisa_stok = :sisa_stok, sisa_stok_tanggal = :sisa_stok_tanggal, type_sisa_stok = :type_sisa_stok WHERE id = :id";
    
        $this->db->query($query);
        $this->db->bind('sisa_stok', $stock['sisa_stok']);
        $this->db->bind('sisa_stok_tanggal', $currentDateTime);
        $this->db->bind('type_sisa_stok', $stock['type_sisa_stok']);
        $this->db->bind('id', $stock['id']);
        $this->db->execute();
    
        return $this->db->rowCount();
    }

    public function getStockById($id)
    {
        $this->db->query("SELECT * FROM stok WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function deleteStock($id)
    {
        $stockInfo = $this->getStockById($id);

        if ($stockInfo) {
            $query = "DELETE FROM stok WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}