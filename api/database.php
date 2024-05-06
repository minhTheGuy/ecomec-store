<?php

class Database {

    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $db = "db";

    public $link;
    public $error;

    public function __construct() {
        $this->connectDB();
    }

    private function connectDB() {
        $this->link = new mysqli($this->host, $this->username, $this->password, $this->db);
        if (!$this->link) {
            $this->error = "Connection failed: " . $this->link->connect_error;
            return false;
        }
    }

    public function getConnection() {
        return $this->link;
    }

    public function query($query) {
        $result = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function escapeString($data) {
        return $this->link->real_escape_string($data);
    }
}
