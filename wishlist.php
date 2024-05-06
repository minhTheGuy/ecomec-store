<?php


include './components/wishlist_cart.php';
include './components/notification.php';

if (isset($_POST['delete'])) {
   $id = $_POST['wishlist_id'];
   $sql = "DELETE FROM `wishlist` WHERE id = $id";
   $delete_wishlist_item = $conn->query($sql);
}

if (isset($_GET['delete_all'])) {
   $uid = $_SESSION['id'];
   $sql = "DELETE FROM `wishlist` WHERE user_id = $uid";
   $delete_wishlist_item = $conn->query($sql);
}
?>
<section class="products">

   <h3 class="heading"><i class="bi bi-bag-heart"></i></h3>

   <div class="container">

      <?php
      if (isset($_SESSION['id'])) {
         $user_id = $_SESSION['id'];
         $grand_total = 0;
         $column_count = 0;
         $sql = "SELECT * FROM `wishlist` WHERE user_id = $user_id";
         $select_wishlist = $conn->query($sql);
         if ($select_wishlist->num_rows > 0) {
            while ($fetch_wishlist = $select_wishlist->fetch_assoc()) {

               if ($column_count == 0) {
                  echo '<div class="row row-cols-1 row-cols-xl-2">';
                  $column_count++;
               } else {
                  $column_count++;
               }
      ?>

               <div class="col p-5">
                  <form method="post" class="box">
                     <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                     <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>

                     <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="" class="img-fluid">
                     <div class="text-center"><?= $fetch_wishlist['name']; ?></div>
                     <div class="d-flex justify-content-center gap-3">
                        <div class="price">vnđ.<?= $fetch_wishlist['price']; ?>/-</div>
                     </div>
                     <input type="submit" value="delete item" class="delete-btn" name="delete">
                  </form>
               </div>

               <?php
               if ($column_count == 2) {
                  echo '</div>';
                  $column_count = 0;
               }
               ?>
      <?php
            }
         } else {
            echo '<p class="text-center lead">Your wishlist is empty</p>';
         }
      } else {
         echo '<p class="text-center lead">Login to see your wishlist</p>';
      }
      ?>

   </div>
   <?php
   if (isset($_SESSION['id'])) {
   ?>
      <div class="w-50 mx-auto d-flex justify-content-around align-items-center gap-5">
         <a href="?page=home" class="option-btn">Continue Shopping.</a>
         <a href="?page=wishlist&delete_all=1" class="<?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
      </div>
   <?php
   } ?>

</section>