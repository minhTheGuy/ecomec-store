<?php
session_start();
include '../api/database.php';
$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {

        $name = $_POST['name'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            echo 0;
            return;
        }

        if (strlen($password) < 6) {
            echo 0;
            return;
        }

        $sql = "UPDATE users SET username = '$name', password = '$password' WHERE id = " . $_SESSION['id'];
        $conn->query($sql);
        echo 1;
        return;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
else {
    echo 404;
}
