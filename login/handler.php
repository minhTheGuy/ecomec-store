<?php
include '../api/gateway.php';
$login = new Login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginmsg = $login->login($username, $password);

    if ($loginmsg) {
        $_SESSION['message'] = $loginmsg;
        header("Location: ../login/login.php");
    }
    else {
        $_SESSION['message'] = "Login successful!";
        header("Location: ../index.php");
    }
}

else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $checkPass = $_POST['checkPass'];

    if ($password != $checkPass) {
        $_SESSION['message'] = "Password does not match";
        header("Location: ../login/register.php");
    }
    $register = $login->register($email, $username, $password);
    if ($register) {
        $_SESSION['message'] = "Registration successful!";
        $_SESSION['status'] = 1;
        // header("Location: http://localhost/webapp/login/register.php");
        header("Location: ../login/register.php");
    } else {
        $_SESSION['message'] = "Registration failed!";
        $_SESSION['status'] = 0;
        header("Location: ../login/register.php");
    }
}
?>