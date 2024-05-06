<?php
    include './components/wishlist_cart.php';
    $conn = new Database();
    include './components/notification.php';
?>
    <style>
    .product-img {
        object-fit: contain;
        padding: .5rem;
        cursor: pointer;
        transition: .2s linear;
    }

    .product-img:hover {
        transform: scale(1.05);
    }

</style>
<section class="quick-view">
    <?php
    $pid = $_GET['pid'];
    $select_products = $conn->query("SELECT * FROM `products` WHERE id = $pid");
    if ($select_products->num_rows > 0) {
        while ($fetch_product = $select_products->fetch_assoc()) {
    ?>
            <form method="post">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                <div class="row mb-3 text-center w-75 mx-auto p-3 rounded-3">
                    <div class="col-md-8 themed-grid-col">
                        <div class="themed-grid-col">
                            <img class="product-img img-fluid w-50 rounded-5" src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                        </div>
                        <div class="row">
                            <img class="product-img col-sm-4 themed-grid-col img-fluid rounded-5" src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                            <img class="product-img col-sm-4 themed-grid-col img-fluid rounded-5" src="uploaded_img/<?= $fetch_product['image_02']; ?>" alt="">
                            <img class="product-img col-sm-4 themed-grid-col img-fluid rounded-5" src="uploaded_img/<?= $fetch_product['image_03']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-4 themed-grid-col d-flex flex-column align-items-center justify-content-center">
                        <div class="display-6"><?= $fetch_product['name']; ?></div>
                        <div class="d-flex gap-3 p-3">
                            <div class="lead"><span></span><?= $fetch_product['price']; ?> .vnđ</div>
                            <input class="form-control w-25" type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        </div>
                        <div class="fs-6 text-start mb-5">Info: <?= $fetch_product['details']; ?></div>
                        <div class="d-flex justify-content-between gap-3">
                            <input type="submit" value="add to cart" class="btn btn-outline-dark" name="add_to_cart">
                            <input class="btn btn-outline-secondary" type="submit" name="add_to_wishlist" value="add to wishlist">
                        </div>
                    </div>
                </div>
            </form>
    <?php
        }
    } else {
        echo '<p class="empty">no products added yet!</p>';
    }
    ?>
</section>
<script>
    // image gallery
    let mainImage = document.querySelector(".themed-grid-col img");
    let subImages = document.querySelectorAll(".themed-grid-col img");

    subImages.forEach((images) => {
        images.onclick = () => {
            src = images.getAttribute("src");
            mainImage.src = src;
        };
    });
</script>