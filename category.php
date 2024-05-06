<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="styles/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="products">

      <h1 class="heading">Category</h1>

      <div class="box-container">

         <?php
         $category = $_GET['category'];
         $select_products = $conn->query("SELECT * FROM `products` WHERE name LIKE '%{$category}%'");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                  <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                  <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                  <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                  <div class="name"><?= $fetch_product['name']; ?></div>
                  <div class="flex">
                     <div class="price"><span>Nrs.</span><?= $fetch_product['price']; ?><span>/-</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products found!</p>';
         }
         ?>

      </div>

   </section>
   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>