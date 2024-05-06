<?php

require_once 'database.php';

class Dashboard {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        return $result;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function getOrders()
    {
        $query = "SELECT * FROM orders";
        $result = $this->db->query($query);
        return $result;
    }

    public function getOrderById($id)
    {
        $query = "SELECT * FROM orders WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function getTotalSales() {
        $total_sales = 0;
        $query = "SELECT SUM(total) as total FROM daily_sale WHERE DATE(createdAt) = CURDATE()";
        $result = $this->db->query($query);

        while ($row = $result->fetch_assoc()) {
            $total_sales += $row['total'];
        }

        return $total_sales;
    }

    public function getSales() {
        $query = "SELECT * FROM daily_sale";
        $result = $this->db->query($query);
        return $result;
    }

    public function getSaleByDay($date) {
        $query = "SELECT * FROM daily_sale WHERE DATE(createdAt) = '$date'";
        $result = $this->db->query($query);
        return $result;
    }

    public function searchOrder($search)
    {
        $query = "SELECT * FROM orders WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR address LIKE '%$search%'";
        $result = $this->db->query($query);
        return $result;
    }

}