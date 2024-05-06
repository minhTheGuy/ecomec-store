<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<style>
    .form-box {
        padding: 48px 40px 36px;
    }

    @media screen and (min-width: 768px) {
        .form-box {
            width: 50%;
        }
    }
</style>
<body>
    <div class="container mt-5">
        <div class="form-box mx-auto bg-light rounded-4 mb-3">
            <div class="d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                </svg>
            </div>
            <h2 class="text-center my-5">Password Change</h2>
            <form method="post" action="password_reset_code.php">
                <input type="hidden" name="token" value="<?php if(isset($_GET['token'])) echo $_GET['token']; ?>">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>" placeholder="">
                    <label for="email">Enter Your Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" placeholder="">
                    <label for="username">New Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" placeholder="">
                    <label for="password">New Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="confirm_password" placeholder="">
                    <label for="confirm_password">Confirm Your Password</label>
                </div>
                <div class="mb-5">
                    <p><a class="link-opacity-75-hover" href="./password_reset.php">Forgot your password?</a></p>
                </div>
                <div class="mb-1 d-flex justify-content-center align-items-center">
                    <?php
                    if (isset($_GET['action'])) {
                        header("Location: register.php");
                    }
                    ?>
                    <button class="btn btn-outline-dark px-4 py-2" type="submit" name="password_update">Update Account!</button>
                </div>
                <?php if (isset($loginmsg)) { 
                    echo '<div class="alert alert-danger" role="alert">' . $loginmsg . '</div>';
                    }
                ?>
            </form>
            <?php 
                if (isset($_SESSION['status'])) {
                    if ($_SESSION['status'] == 1) {
                        echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                        echo '<a href="./login.php" class="btn btn-outline-dark px-4 py-2">Click here to go back login</a>';
                    }
                    else
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['status']);
                    unset($_SESSION['message']);
                }
            ?>
        </div>
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb" class="w-50 mx-auto">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">About Us</a></li>
                <li class="breadcrumb-item"><a href="login.php">Go back to login</a></li>
                <li class="breadcrumb-item active" aria-current="page">Privacy</li>
                <li class="breadcrumb-item" aria-current="page">Terms</li>
            </ol>
        </nav>
    </div>
</body>

</html>