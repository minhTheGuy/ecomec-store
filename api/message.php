<?php

require_once 'database.php';

class Message {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMessages()
    {
        $query = "SELECT * FROM messages";
        $result = $this->db->query($query);
        return $result;
    }

}

