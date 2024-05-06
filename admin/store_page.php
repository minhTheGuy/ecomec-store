<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Store</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Store</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Overview</a>
                </li>
            </ul>
        </div>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3>
                    <?php
                    include '../api/store.php';
                    $store = new Store();
                    $products = $store->getProducts();
                    if ($products) {
                        echo $products->num_rows;
                    }
                    ?>
                </h3>
                <p>New Product</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-shopping-bag'></i>
            <span class="text">
                <a href="./addProduct_page.php">Create Product</a>
            </span>
        </li>
    </ul>


    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Recent Product</h3>
                <form method="post">
                    <input type="text" name="search" placeholder="Search">
                    <input type="submit" value="search" class="btn btn-primary btn-sm">
                    <div class="mb-3 form-check-inline">
                        <input type="checkbox" class="form-check-input" name="filter">
                        <label class="form-check-label" for="exampleCheck1">
                            <i class='bx bx-filter'></i>
                        </label>
                    </div>
                </form>
            </div>
            <div class="bg-body-tertiary p-3 rounded-5">

                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Pricing</th>
                            <th>Details</th>
                            <th>Category</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php

                        if (isset($_POST['search']) && !isset($_POST['filter'])) {
                            $search = $_POST['search'];
                            $products = $store->searchProduct($search);
                        }
                        else if (isset($_POST['filter'])) {
                            $products = $store->filterProduct($_POST['search']);
                        }

                        while ($product = $products->fetch_assoc()) {
                        ?>
                            <tr>
                                <td>
                                    <div class="user">
                                        <img src="../uploaded_img/<?php echo $product['image_01']; ?>" alt="" class="d-block">
                                        <span class="user-info">
                                            <?php echo $product['name']; ?>
                                        </span>
                                    </div>
                                </td>
                                <td><span><?php echo $product['price']; ?> vnđ</span></td>
                                <td><span><?php echo $product['details']; ?></span></td>
                                <td><span><?php echo $product['category']; ?></span></td>
                                <td><a class="btn btn-warning px-4 py-2" href="?action=edit&id=<?php echo $product['id']; ?>">Edit</a></td>
                                <td><a class="btn btn-danger px-4 py-2" href="?action=delete&id=<?php echo $product['id']; ?>">Delete</a></td>
                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- MAIN -->