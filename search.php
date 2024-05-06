<?php
include './components/wishlist_cart.php';
include './components/notification.php';
function loadProduct($product)
{
   $column_count = 0;
   if ($product->num_rows > 0) {
      while ($fetch_product = $product->fetch_assoc()) {
         if ($column_count == 0) {
            echo '<div class="row row-cols-1 row-cols-xl-2">';
            $column_count++;
         } else {
            $column_count++;
         }
   ?>
         <div class="p-5">
            <form method="post" class="box rounded-4">
               <h2 class="fs-2 lead"><?= $fetch_product['name']; ?></h2>
               <p class="fs-6">
                  <?php
                  if (strlen($fetch_product['details']) > 65) {
                     echo substr($fetch_product['details'], 0, 65) . '...';
                  } else {
                     echo $fetch_product['details'];
                  }
                  ?>
               </p>

               <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
               <div class="img-container d-flex justify-content-center">
                  <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" class="img-fluid rounded search-img" alt="...">
               </div>
               <div class="d-flex justify-content-center align-items-center gap-5 m-5">
                  <button class="fas fa-heart rounded-2 p-1" type="submit" name="add_to_wishlist"></button>
                  <a href="?page=quick_view&pid=<?= $fetch_product['id']; ?>" class="fas fa-eye rounded-2 p-1"></a>
               </div>

               <div class="d-flex justify-content-center align-items-center gap-3">
                  <div class="price"><span>vnđ.</span><?= $fetch_product['price']; ?><span>/-</span></div>
                  <label for="qty">Quantity</label>
                  <input class="form-control w-25" type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
               </div>

               <input type="submit" value="add to cart" class="btn btn-outline-dark" name="add_to_cart">
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
      echo '<p class="px-4 py-2 lead">No products found!</p>';
   }
}
?>
<!-- Search form -->
<form class="search-form row px-4 py-2" role="search" method="post">
   <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-1 d-flex justify-content-around">
      <input type="text" class="form-control" name="search_box" placeholder="search by name..." maxlength="100" class="box  rounded-4">
      <button class="p-1" type="submit" name="search_btn"><i class="bi bi-search"></i></button>
      <!-- checkbox click for searching by filter -->
   </div>
   <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex justify-content-between align-items-center">
      <label for="filter" class="mx-3">Search by filter</label>
      <input type="checkbox" class="form-check-input" id="filter" name="filter" class="mx-3">
   </div>
   <!-- select option filter -->
   <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex justify-content-between align-items-center">
      <label for="category" class="mx-3">Category</label>
      <select class="form-select" name="category" id="category">
         <option value="Shoe">Shoe</option>
         <option value="Jacket">Jacket</option>
         <option value="Men">Men</option>
         <option value="Women">Women</option>
         <option value="Kids">Kids</option>
      </select>
   </div>
</form>

<script>
   // search filter
   if (document.getElementById("filter")) {
      document.getElementById("filter").addEventListener("click", function() {
         if (this.checked) {
            document.querySelector('.search-form input[type="text"]').placeholder =
               "search by filter...";
         } else {
            document.querySelector('.search-form input[type="text"]').placeholder =
               "search by name...";
         }
      });
   }
</script>


<!-- Product Container -->
<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">
      <?php
      if (isset($_GET['id']) && !empty($_GET['id']) && (!isset($_POST['search_box']) or !isset($_POST['search_btn']))) {
         $id = $_GET['id'];
         $sql = "SELECT * FROM `products` WHERE id = $id";
         $select_products = $conn->query($sql);
         loadProduct($select_products);
      } else if (isset($_GET['category']) && !empty($_GET['category']) && (!isset($_POST['search_box']) or !isset($_POST['search_btn']))) {
         $key = $_GET['category'];
         $sql = "SELECT * FROM `products` WHERE category LIKE '%$key%'";
         $select_products = $conn->query($sql);
         loadProduct($select_products);
      } else if (!isset($_POST['search_box']) || !isset($_POST['search_btn'])) {
         $sql = "SELECT * FROM `products`";
         $select_products = $conn->query($sql);
         loadProduct($select_products);
      } else if (isset($_POST['search_box']) && isset($_POST['search_btn']) && !isset($_POST['filter'])) {
         $search_box = $_POST['search_box'];
         $sql = "SELECT * FROM `products` WHERE name LIKE '%$search_box%'";
         $select_products = $conn->query($sql);
         loadProduct($select_products);
      }
      // search by filter
      else if (isset($_POST['search_box']) && $_POST['search_box'] != '' && isset($_POST['search_btn']) && isset($_POST['filter']) || isset($_POST['category'])) {
         $search_box = $_POST['search_box'];
         $category = $_POST['category'];

         $filter = explode(' ', $search_box);
         $sql = "SELECT * FROM `products` WHERE category LIKE '%$filter[0]%'";
         foreach ($filter as $key) {
            $sql .= " AND category LIKE '%$key%'";
         }
         $sql .= " OR name LIKE '%$category%'";

         $select_products = $conn->query($sql);
         loadProduct($select_products);
      } else {
         echo '<p class="px-4 py-2 lead">No products found!</p>';
      }
      ?>
   </div>
</section>

<!-- Modal -->
<div class="modal fade" id="img-modal" tabindex="-1">
   <div class="modal-dialog modal-lg">
      <div class="modal-content d-flex justify-content-center p-5">
         <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="img" id="modal-img" class="img-fluid rounded">
      </div>
   </div>
</div>
<!-- End Modal -->