<?php
include './api/database.php';
$conn = new Database();

if (!isset($_SESSION['id'])) {
   $message[] = 'please login first!';
} else if (isset($_POST['add_to_wishlist'])) {

   $uid = $_SESSION['id'];
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $image = $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM wishlist WHERE name = '$name' AND user_id = $uid";
   $check_wishlist_numbers = $conn->query($sql);

   $sql = "SELECT * FROM cart WHERE name = '$name' AND user_id = $uid";
   $check_cart_numbers = $conn->query($sql);

   if ($check_wishlist_numbers->num_rows > 0) {
      $message[] = 'already added to wishlist!';
      $_SESSION['status'] = 'failed';
   } elseif ($check_cart_numbers->num_rows > 0) {
      $message[] = 'already added to cart!';
      $_SESSION['status'] = 'failed';
   } else {
      $sql = "INSERT INTO wishlist(user_id, pid, name, price, image) VALUES($uid, $pid, '$name', $price, '$image')";
      $insert_wishlist = $conn->query($sql);
      $message[] = 'added to wishlist!';
      $_SESSION['status'] = 'success';
   }

} else if (isset($_POST['add_to_cart'])) {

   $uid = $_SESSION['id'];
   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $image = $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM cart WHERE name = '$name' AND user_id = $uid";
   $check_cart_numbers = $conn->query($sql);

   if ($check_cart_numbers->num_rows > 0) {
      $message[] = 'already added to cart!';
      $_SESSION['status'] = 'failed';
   } else {

      $sql = "SELECT * FROM wishlist WHERE name = '$name' AND user_id = $uid";
      $check_wishlist_numbers = $conn->query($sql);

      if ($check_wishlist_numbers->num_rows > 0) {
         $sql = "DELETE FROM wishlist WHERE name = '$name' AND user_id = $uid";
         $delete_wishlist = $conn->query($sql);
      }

      $sql = "INSERT INTO cart(user_id, pid, name, price, quantity, image) VALUES($uid,$pid,'$name',$price,$qty,'$image')";
      $insert_cart = $conn->query($sql);
      $message[] = 'added to cart!';
      $_SESSION['status'] = 'success';
   }
}