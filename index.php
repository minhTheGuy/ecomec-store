<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOMEC</title>
    
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    
    <!-- Bootstrap.min.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Bootstrap.bundle.min.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Bootstrap-icons.min.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- SwiperJS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap-growl -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
    
    <!-- Internal style -->
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body style="background-color: white;">

    <?php include 'components/user_header.php'; ?>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'home':
                include 'home.php';
                break;
            case 'search':
                include 'search.php';
                break;
            case 'wishlist':
                include 'wishlist.php';
                break;
            case 'cart':
                include 'cart.php';
                break;
            case 'quick_view':
                include 'quick_view.php';
                break;
            case 'profile':
                include 'profile.php';
                if (isset($_GET['action'])) {
                    if ($_GET['action'] == 'edit') {
                        echo '<script>window.location.href="./edit_profile.php"</script>';
                    } else if ($_GET['action'] == 'change') {
                        echo '<script>window.location.href="./change_password.php"</script>';
                    }
                }
                break;
            default:
                include 'home.php';
                break;
        }
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'logout') {
            session_destroy();

    ?>
            <script>
                window.location.href = "./login/login.php"
            </script>
            <?php
        }
        switch ($action) {
            case 'logout':
                session_destroy();
            ?>
                <script>
                    window.location.href = "./login/login.php"
                </script>
    <?php
                break;
        }
    } else include 'home.php';
    ?>

    <?php include 'components/footer.php'; ?>
    <script src="./script/script.js"></script>
</body>

</html>