<?php
session_start();
include 'database.php';
$conn = new Database();
if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    // $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
    $sql = "DELETE FROM `cart` WHERE id = $cart_id";
    $delete_cart_item = $conn->query($sql);
    if ($delete_cart_item) {
        $_SESSION['message'] = ' deleted from cart!';
        $_SESSION['status'] = 'success';
    } else {
        $message[] = 'failed to delete from cart!';
    }
}

if (isset($_GET['delete_all'])) {
    $user_id = $_SESSION['id'];
    $sql = "DELETE FROM `cart` WHERE user_id = $user_id";
    $delete_cart_item = $conn->query($sql);
    if ($delete_cart_item) {
        $_SESSION['message'] = ' deleted all from cart!';
        $_SESSION['status'] = 'success';
    } else {
        $_SESSION['message'] = ' failed to delete all from cart!';
    }
}
