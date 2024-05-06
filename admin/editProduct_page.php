<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/style.css">
    <title>Ecomec Store</title>
</head>

<body>
    <div class="container px-4 py-2">
        <main>
            <div class="text-center">
                <h2>Edit Product</h2>
            </div>

            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 col px-4 py-2">
                    <form method="post" id="edit">
                        <?php
                        include '../api/database.php';
                        $conn = new Database();
                        $id = $_GET['id'];
                        $product = $conn->query("SELECT * FROM `products` WHERE id = $id");
                        $product = $product->fetch_assoc();
                        ?>
                        <div class="row g-3">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $product['name'] ?>" required>
                            </div>

                            <div class="col-12">
                                <div class="col">
                                    <label for="details" class="form-label">Details</label>
                                    <textarea class="form-control" placeholder="Leave a comment here" name="details" id="details" class="form-label" style="height: 100px" required><?php echo $product['details']; ?></textarea>
                                </div>

                            </div>

                            <div class="col-12">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">đ</span>
                                    <input type="number" class="form-control" id="price" min="0" class="box" required max="9999999999" placeholder="enter product price" value="<?php echo $product['price']; ?>" onkeypress="if(this.value.length == 10) return false;" name="price">
                                </div>
                                <div class="form-text" id="basic-addon4">currency: vnđ</div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="img_01" class="form-label">Image I for the product</label>
                                    <input class="form-control" type="file" id="img_01" name="img_01">
                                    <img src="../uploaded_img/<?php echo $product['image_01']; ?>" alt="" style="width: 100px; height: 100px;" accept=".jpeg, .jpg, .png">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="img_02" class="form-label">Image II for the product</label>
                                    <input class="form-control" type="file" id="img_02" name="img_02" accept=".jpeg, .jpg, .png">
                                    <img src="../uploaded_img/<?php echo $product['image_02']; ?>" alt="" style="width: 100px; height: 100px;">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="img_03" class="form-label">Image III for the product</label>
                                    <input class="form-control" type="file" id="img_03" name="img_03" accept=".jpeg, .jpg, .png">
                                    <img src="../uploaded_img/<?php echo $product['image_03']; ?>" alt="" style="width: 100px; height: 100px;">
                                </div>
                            </div>

                            <div class="form-check">
                                <input class="form-check" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check" for="flexCheckDefault">
                                    Insert category by words
                                </label>
                            </div>

                            <div class="col-md-3" id="select">
                                <label for="country" class="form-label">Category</label>
                                <select class="form-select" name="select_category" id="select_category" required>
                                    <option value="">Choose...</option>
                                    <option value="shoe">Shoes</option>
                                    <option value="clothes">Clothes</option>
                                    <option value="sneaker">Sneakers</option>
                                    <option value="sweather">Sweathers</option>
                                    <option value="jacket">Jackets</option>
                                </select>
                            </div>

                            <div class="d-none" id="input">
                                <label for="input_category" class="form-label">Category</label>
                                <input type="text" class="form-control" name="input_category" id="input_category" placeholder="Enter Category...">
                            </div>
                        </div>

                        <hr class="my-4">
                        <button type="submit" class="w-100 btn btn-primary btn-lg">Edit</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-1 pt-5 text-body-secondary text-center text-small">
            <p class="mb-1">© 2017–2024 Ecomec Corp</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
    </div>

    <script>
        const checkbox = document.querySelector('#flexCheckDefault');
        const select = document.querySelector('#select');
        const input = document.querySelector('#input');
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                // select.classList.add('d-none');
                select.innerHTML = '';
                input.classList.remove('d-none');
            } else {
                // select.classList.remove('d-none');
                innerHTML = `
                                <label for="country" class="form-label">Category</label>
                                <select class="form-select" name="select_category" id="category" required>
                                    <option value="">Choose...</option>
                                    <option value="shoe">Shoes</option>
                                    <option value="clothes">Clothes</option>
                                    <option value="sneaker">Sneakers</option>
                                    <option value="sweather">Sweathers</option>
                                    <option value="jacket">Jackets</option>
                                </select>
                `;
                select.innerHTML = innerHTML;
                input.classList.add('d-none');
            }
        });

        const form = document.querySelector('#edit');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const id = <?php echo $_GET['id']; ?>;
            const name = document.querySelector('#name').value;
            const details = document.querySelector('#details').value;
            const price = document.querySelector('#price').value;
            const img_01 = document.querySelector('#img_01').files[0];
            const img_02 = document.querySelector('#img_02').files[0];
            const img_03 = document.querySelector('#img_03').files[0];
            const category = document.querySelector('#flexCheckDefault').checked ? document.querySelector('#input_category').value : document.querySelector('#select_category').value;


            const formData = new FormData();
            formData.append('id', id);
            formData.append('name', name);
            formData.append('details', details);
            formData.append('price', price);
            formData.append('img_01', img_01);
            formData.append('img_02', img_02);
            formData.append('img_03', img_03);
            formData.append('category', category);

            const response = await fetch('../api/edit_product.php', {
                method: 'POST',
                body: formData
            });

            window.location.href = 'index.php?layout=store';
        });
    </script>
</body>

</html>