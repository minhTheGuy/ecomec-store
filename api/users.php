<?php

include 'database.php';

class Users {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = $id";
        $this->db->query($sql);
    }

    public function updateUser($id, $username, $password, $email, $role) {
        $sql = "UPDATE users SET username = '$username', password = '$password', email = '$email', role = '$role' WHERE id = $id";
        $this->db->query($sql);
    }

    public function createUser($username, $password, $email, $role) {
        $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
        $this->db->query($sql);
    }

    public function searchUsers($search) {
        $sql = "SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%'";
        $result = $this->db->query($sql);
        return $result;
    }
}

?>