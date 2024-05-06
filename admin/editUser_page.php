<?php
include '../api/database.php';
$conn = new Database();
$id = $_GET['id'];
$users = $conn->query("SELECT * FROM `users` WHERE id = $id");
$user = $users->fetch_assoc();
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
                <h2>Edit User</h2>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-8 col px-4 py-2">
                    <form method="post" id="edit">
                        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id']; ?>">
                        <div class="row g-3">
                            <div class="col">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $user['username'] ?>" required>
                            </div>

                            <div class="col-12">
                                <div class="col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $user['email']; ?>" required>
                                </div>

                            </div>


                            <div class="col-md-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Choose...</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button type="submit" class="w-50 btn btn-primary btn-lg">Edit</button>
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
</body>
<script>
    document.querySelector('#role').value = '<?php echo $user['role']; ?>';
    const form = document.querySelector('#edit');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const id = <?php echo $_GET['id']; ?>;
        const username = document.querySelector('#username').value;
        const email = document.querySelector('#email').value;
        const role = document.querySelector('#role').value;

        const formData = new FormData();
        formData.append('id', id);
        formData.append('username', username);
        formData.append('email', email);
        formData.append('role', role);

        const response = await fetch('../api/update_user.php', {
            method: 'POST',
            body: formData
        });

        window.location.href = 'index.php?layout=users';
    });

</script>

</html>