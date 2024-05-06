<?php
include '../api/session.php';
Session::init();
if (Session::get("login") == false || Session::get("role") == "user") {
    header("Location: ../login/login.php");
}
?>


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
                <h2>Update Account Form</h2>
            </div>

            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 col px-4 py-2">
                    <form method="post">
                        <div class="row mb-5">
                            <div class="col">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- check password -->
                            <div class="col">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button type="submit" class="w-100 btn btn-primary btn-lg">Update</button>
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
        const form = document.querySelector('form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.querySelector('#name').value;
            const password = document.querySelector('#password').value;
            const confirm_password = document.querySelector('#confirm_password').value;

            const formData = new FormData();
            formData.append('name', username);
            formData.append('password', password);
            formData.append('confirm_password', confirm_password);

            console.log(123);

            const response = await fetch('../api/account_update.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();
            if (data === 1) {
                alert('Update account successfully');
                window.location.href = '../login/login.php';
            } else {
                alert('Update account failed');
                window.location.href = './index.php?layout=dashboard';
            }
        });
    </script>
</body>

</html>