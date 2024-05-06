<?php
session_start();
include 'database.php';
$conn = new Database();

$cart_count = 0;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM `cart` WHERE user_id = $user_id";
    $select_cart = $conn->query($sql);
    $cart_count = $select_cart->num_rows;
}
$wishlist_count = 0;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM `wishlist` WHERE user_id = $user_id";
    $select_wishlist = $conn->query($sql);
    $wishlist_count = $select_wishlist->num_rows;
}

echo json_encode(array('cart_count' => $cart_count, 'wishlist_count' => $wishlist_count));