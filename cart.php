<?php
include './components/wishlist_cart.php';

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $sql = "UPDATE `cart` SET quantity = $qty WHERE id = $cart_id";
   $update_qty = $conn->query($sql);
   $message[] = 'cart quantity updated';
}

if (isset($_SESSION['status']) && $_SESSION['status'] == 'success') {
   echo 2;
?>
   <script>
      $(document).ready(function() {
         $.bootstrapGrowl("<?= $_SESSION['message'] ?>", {
            type: 'success',
            align: 'center',
            width: 'auto',
            allow_dismiss: true
         });
      });
   </script>
<?php
   unset($_SESSION['message']);
   unset($_SESSION['status']);
} else if (isset($message) && (isset($_POST['add_to_cart']) || isset($_POST['add_to_wishlist']))) {
   echo 1;
?>
   <script>
      $(document).ready(function() {
         $.bootstrapGrowl("<?= $message[0] ?>", {
            type: 'success',
            align: 'center',
            width: 'auto',
            allow_dismiss: true
         });
      });
   </script>
<?php
}
?>
<section class="products shopping-cart">
   <h3 class="heading"><i class="bi bi-bag"></i></h3>

   <div class="container">
      <?php
      if (isset($_SESSION['id'])) {
         $user_id = $_SESSION['id'];

         $grand_total = 0;
         $column_count = 0;

         $sql = "SELECT * FROM `cart` WHERE user_id = $user_id";
         $select_cart = $conn->query($sql);

         if ($select_cart->num_rows > 0) {
            while ($fetch_cart = $select_cart->fetch_assoc()) {

               if ($column_count == 0) {
                  echo '<div class="row row-cols-1 row-cols-xl-2">';
                  $column_count++;
               } else {
                  $column_count++;
               }
      ?>

               <div class="col p-5">
                  <form method="post" class="box">
                     <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>" id="<?= $fetch_cart['id']; ?>">
                     <a href="?page=quick_view&pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>

                     <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="" class="img-fluid rounded-5">
                     <div class="text-center"><?= $fetch_cart['name']; ?></div>
                     <div class="d-flex justify-content-center align-items-center gap-3">
                        <div class="price"><?= $fetch_cart['price']; ?> vnđ. </div>
                        <input class="form-control w-25" type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                        <button class="fas fa-edit" type="submit" name="update_qty"></button>
                     </div>
                     <div class="text-center"> Sub Total : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?> vnđ</span> </div>
                     <input class="btn btn-outline-dark delete-btn" type="submit" value="delete item" name="delete">
                  </form>
               </div>

               <?php
               if ($column_count == 2) {
                  echo '</div>';
                  $column_count = 0;
               }
               ?>
      <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="text-center lead">Your cart is empty</p>';
         }
      } else {
         echo '<p class="text-center lead">Login to see your cart</p>';
      }
      ?>
   </div>

   <?php
   if (isset($_SESSION['id'])) {
   ?>
      <p class="lead text-center">Grand Total : <span>vnđ.<?= $grand_total; ?>/-</span></p>
      <div class="d-flex justify-content-center align-items-center gap-5">
         <a href="?page=home" class="option-btn">Continue Shopping.</a>
         <a class="delete-all-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" z>Delete All Items ?</a>
         <a href="?page=cart&action=checkout" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" data-bs-toggle="modal" data-bs-target="#modal">Proceed to Checkout.</a>
      </div>
   <?php
      include './checkout.php';
   } ?>

</section>