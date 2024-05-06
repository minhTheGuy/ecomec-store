<?php
session_start();
include 'database.php';
$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['user_update'])) {

    $id = $_POST['id'];
    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $role = $_POST['role'];

    try {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        $sql = "SELECT * FROM users WHERE email = '$email' AND id <> $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = 'Email already exists';
        }

        $sql = "SELECT * FROM users WHERE username = '$username' AND id <> $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = 'Username already exists';
        }

        $sql = "UPDATE users SET username = '$username', email = '$email', role = '$role' WHERE id = $id";
        $conn->query($sql);
        echo 1;
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        echo 0;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_update'])) {
    if ($_POST['user_update'] === 'password') {
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password != $confirm_password) {
            echo 0;
            return;
        }

        if (strlen($password) < 8) {
            echo 0;
            return;
        }

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$hash_password' WHERE email = '$email'";
        $conn->query($sql);
        echo 1;
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);

        try {
            $sql = "SELECT * FROM user_info WHERE user_id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                $sql = "SELECT email FROM users WHERE id = $id";
                $email = $conn->query($sql);
                $email = $email->fetch_assoc()['email'];
                $sql = "INSERT INTO user_info (user_id, name, number, email, address) VALUES ($id, '$name', '$number', '$email', '$address')";
                $conn->query($sql);
                echo 1;
                exit(0);
            }

            $sql = "UPDATE user_info SET name = '$name', number = '$number', address = '$address' WHERE user_id = $id";
            $conn->query($sql);
            echo 1;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            echo 0;
        }
    }
}
