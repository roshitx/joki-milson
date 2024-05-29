<?php

class User_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    // Cashier
    public function getAllCashier()
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE role = 'cashier'");
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function getUserByUsername($username)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function addCashier($cashier)
    {
        $query = "INSERT INTO users (name, username, password, email, role)
                    VALUES
                    (:name, :username, :password, :email, 'cashier')";

        $hashedPassword = password_hash($cashier['password'], PASSWORD_DEFAULT);

        $this->db->query($query);
        $this->db->bind('name', $cashier['name']);
        $this->db->bind('username', $cashier['username']);
        $this->db->bind('email', $cashier['email']);
        $this->db->bind('password', $hashedPassword);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getCashierById($id)
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateCashier($cashier)
    {
        $query = "UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('name', $cashier['name']);
        $this->db->bind('username', $cashier['username']);
        $this->db->bind('email', $cashier['email']);
        $this->db->bind('id', $cashier['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteCashier($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
