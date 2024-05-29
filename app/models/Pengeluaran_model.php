<?php

class Pengeluaran_model
{
    private $table = 'pengeluaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPengeluaran()
    {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY date ASC");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addPengeluaran($pengeluaran)
    {   
        $currentDateTime = date('Y-m-d H:i:s');

        $query = "INSERT INTO " . $this->table . " (date, type, description, amount)
                  VALUES
                  (:date, :type, :description, :amount)";

        $this->db->query($query);
        $this->db->bind('date', $currentDateTime);
        $this->db->bind('type', $pengeluaran['type']);
        $this->db->bind('description', $pengeluaran['description']);
        $this->db->bind('amount', $pengeluaran['amount']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updatePengeluaran($pengeluaran)
    {
        $query = "UPDATE " . $this->table . " SET type = :type, description = :description, amount = :amount WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('type', $pengeluaran['type']);
        $this->db->bind('description', $pengeluaran['description']);
        $this->db->bind('amount', $pengeluaran['amount']);
        $this->db->bind('id', $pengeluaran['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPengeluaranById($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }


    public function deletePengeluaran($id)
    {
        $pengeluaranId = $this->getPengeluaranById($id);

        if ($pengeluaranId) {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}
