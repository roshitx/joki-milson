<?php

class Salary_model
{
    private $table = 'salary';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSalary()
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

    // public function getSelectedMenus()
    // {
    //     $this->db->query("SELECT * FROM " . $this->table . " LIMIT 4");
    //     $this->db->execute();
    //     return $this->db->resultSet();
    // }

    public function addSalary($salary)
    {
        $currentDateTime = date('Y-m-d H:i:s'); // Dapatkan waktu sekarang dengan format YYYY-MM-DD HH:MM:SS
    
        $query = "INSERT INTO " . $this->table . " (cashier_name, present, monthly_sal, salary, overtime, month, created_at)
                  VALUES
                  (:cashier_name, :present, :monthly_sal, :salary, :overtime, :month, :created_at)";
    
        $this->db->query($query);
        $this->db->bind('cashier_name', $salary['cashier_name']);
        $this->db->bind('present', $salary['present']);
        $this->db->bind('monthly_sal', $salary['monthly_sal']);
        $this->db->bind('salary', $salary['salary']);
        $this->db->bind('overtime', $salary['overtime']);
        $this->db->bind('month', $salary['month']);
        $this->db->bind('created_at', $currentDateTime);
        $this->db->execute();
    
        return $this->db->rowCount();
    }

    public function getSalaryById($id)
    {
        $this->db->query("SELECT * FROM salary WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function updateSalary($salary)
    {
        $query = "UPDATE salary SET cashier_name = :cashier_name, monthly_sal = :monthly_sal, present = :present, salary = :salary, overtime = :overtime, month = :month WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('cashier_name', $salary['cashier_name']);
        $this->db->bind('monthly_sal', $salary['monthly_sal']);
        $this->db->bind('present', $salary['present']);
        $this->db->bind('salary', $salary['salary']);
        $this->db->bind('overtime', $salary['overtime']);
        $this->db->bind('month', $salary['month']);
        $this->db->bind('id', $salary['id']);
        $this->db->execute();
    
        return $this->db->rowCount();
    }
    

    public function deleteSalary($id)
    {
        $salaryInfo = $this->getSalaryById($id);

        if ($salaryInfo) {
            $query = "DELETE FROM salary WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 0;
    }
}