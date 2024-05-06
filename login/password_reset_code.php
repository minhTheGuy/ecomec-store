<?php
session_start();
include '../api/database.php';
$db = new Database();

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions

function send_password_reset($name, $email, $token)
{

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;
        //Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'dangminh1312@gmail.com';                     //SMTP username
        $mail->Password   = 'uuho qxkb delk dvwb';
        //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dangminh1312@gmail.com', $name);
        $mail->addAddress($email);     //Add a recipient

        $email_template = "
        <html>
        <head>
            <title>HTML email</title>
        </head>
        <body>
            <p>You have received this email because you have requested password recovery, if you don't do it, please don't click the link below!</p>
            <br>
            <a href='https://nguyenhuynhdangminh2024.000webhostapp.com/login/password_change.php?token=$token&email=$email'>Click here to reset your password</a>
        </body>
        </html>";

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Recovery';
        $mail->Body    = $email_template;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($db->getConnection(), $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $check_email_run = $db->query($check_email);

    if ($check_email_run->num_rows > 0) {
        $row = $check_email_run->fetch_assoc();
        $get_name = $row['username'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = $db->query($update_token);
        if ($update_token_run > 0) {
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['message'] = "Password reset link sent to your email!";
            $_SESSION['status'] = 1;
            header("Location: password_reset.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Something went wrong!";
            $_SESSION['status'] = 0;
            header("Location: password_reset.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Email not found, please try again!";
        $_SESSION['status'] = 0;
        header("Location: password_reset.php");
        exit(0);
    }
}

if (isset($_POST['password_update'])) {
    $username = mysqli_real_escape_string($db->getConnection(), $_POST['username']);
    $email = mysqli_real_escape_string($db->getConnection(), $_POST['email']);
    $new_password = mysqli_real_escape_string($db->getConnection(), $_POST['password']);
    $confirm_password = mysqli_real_escape_string($db->getConnection(), $_POST['confirm_password']);
    $token = mysqli_real_escape_string($db->getConnection(), $_POST['token']);

    if (!empty($token)) {

        if (!empty($token) && !empty($new_password) && !empty($confirm_password)) {

            $check_token = "SELECT verify_token FROM users WHERE verify_token = '$token' LIMIT 1";
            $check_token_run = $db->query($check_token);

            if ($check_token_run->num_rows > 0) {
                
                if (strlen($new_password) < 8) {
                    $_SESSION['message'] = "Password must be at least 8 characters";
                    $_SESSION['status'] = 0;
                    header("Location: password_change.php");
                    exit(0);
                } else if ($new_password != $confirm_password) {
                    $_SESSION['message'] = "Password and Confirm Password do not match!";
                    $_SESSION['status'] = 0;
                    header("Location: password_change.php");
                    exit(0);
                }
                else {
                    $hash_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $updateAccount = "UPDATE users SET username = '$username', password = '$hash_password' WHERE email = '$email' LIMIT 1";
                    $updateAccount = $db->query($updateAccount);

                    if ($updateAccount > 0) {
                        $_SESSION['message'] = "Password updated!";
                        $_SESSION['status'] = 1;
                        header("Location: password_change.php");
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Password not updated!";
                        $_SESSION['status'] = 0;
                        header("Location: password_change.php");
                        exit(0);
                    }
                }
            } else {
                $_SESSION['message'] = "Password and Confirm Password do not match!";
                $_SESSION['status'] = 0;
                header("Location: password_change.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Password not updated!";
            $_SESSION['status'] = 0;
            header("Location: password_change.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Token not found!";
        $_SESSION['status'] = 0;
        header("Location: password_change.php");
        exit(0);
    }
}
