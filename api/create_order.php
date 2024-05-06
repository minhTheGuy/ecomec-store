<?php
include 'database.php';
session_start();
$conn = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $id = $_POST['uid'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $total_price = $_POST['total'];
        $save_info = $_POST['save_info'];

        $sql = "SELECT * FROM cart WHERE user_id = $id";
        $cart_item = $conn->query($sql);
        $total_products = "";
        while ($fetch_cart_item = $cart_item->fetch_assoc()) {
            $total_products .= $fetch_cart_item['name'] . " x " . $fetch_cart_item['quantity'] . ", ";
        }

        $sql = "INSERT INTO orders (user_id, name, number, email, address, total_products, total_price, placed_on) VALUES ('$id', '$name', '$phone', '$email', '$address', '$total_products', '$total_price', NOW())";
        $order = $conn->query($sql);
        if ($order) {
            $sql = "DELETE FROM cart WHERE user_id = $id";
            $delete_cart = $conn->query($sql);
            if ($delete_cart) {

                if ($save_info == 'on') {
                    $sql = "SELECT * FROM user_info WHERE user_id = $id";
                    $user_info = $conn->query($sql);
                    if ($user_info->num_rows > 0) {
                        $sql = "UPDATE user_info SET name = '$name', number = '$phone', email = '$email', address = '$address' WHERE user_id = $id";
                        $update_user = $conn->query($sql);
                    } else {
                        $sql = "INSERT INTO user_info (user_id, name, number, email, address) VALUES ('$id', '$name', '$phone', '$email', '$address')";
                        $update_user = $conn->query($sql);
                    }
                    $update_user = $conn->query($sql);
                }
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = 'cart emptied!';
            }

        }
        else {
            $_SESSION['status'] = 'failed';
            $_SESSION['message'] = 'failed to create order!';
        }

        header('location: ../index.php?page=cart');

    } catch (Exception $e) {
        echo $e->getMessage();
    }
};
