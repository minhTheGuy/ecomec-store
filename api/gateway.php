<?php

include '../api/database.php';
session_start();

class Login
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($username, $password)
    {
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if (empty($username) || empty($password)) {
            $loginmsg = "Username or Password must not be empty";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = $this->db->query($query);

            if ($result->num_rows > 0) {
                $value = $result->fetch_assoc();
                $isValid = password_verify($password, $value['password']);
                if ($isValid) {
                    if ($value['role'] == 'admin') {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $value['username'];
                        $_SESSION['id'] = $value['id'];
                        $_SESSION['time'] = time() + 3600;
                        $_SESSION['role'] = "admin";
                        header("Location: ../admin/index.php");
                        exit(0);
                    } else if ($value['role'] == 'user') {
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $value['username'];
                        $_SESSION['id'] = $value['id'];
                        $_SESSION['time'] = time() + 3600;
                        $_SESSION['role'] = "user";
                        header("Location: ../index.php");
                        exit(0);
                    }
                }
                else {
                    $loginmsg = "Something Went Wrong!, please try again later";
                    $_SESSION['message'] = $loginmsg;
                    header("Location: ../login/login.php");
                    exit(0);
                }
            } else {
                $loginmsg = "Username or Password is not valid, please try again";
                $_SESSION['message'] = $loginmsg;
                header("Location: ../login/login.php");
                exit(0);
            }
        }
    }

    public function register($email, $username, $password)
    {
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if (empty($username) || empty($password) || empty($email)) {
            $registermsg = "Username or Password or Email must not be empty";
            $_SESSION['message'] = $registermsg;
            header("Location: ../login/register.php");
            exit(0);
        } else {
            if (strlen($password) < 8) {
                $registermsg = "Password must be at least 8 characters";
                $_SESSION['message'] = $registermsg;
                header("Location: ../login/register.php");
                exit(0);
            }else if (preg_match('/\s/', $username)) {
                $registermsg = "Username must not include any space!";
                $_SESSION['message'] = $registermsg;
                header("Location: ../login/register.php");
                exit(0);
            } else if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
                $registermsg = "Username must not include any special character!";
                $_SESSION['message'] = $registermsg;
                header("Location: ../login/register.php");
                exit(0);
            } else if (preg_match('/\s/', $email)) {
                $registermsg = "Email must not include any space!";
                $_SESSION['message'] = $registermsg;
                header("Location: ../login/register.php");
                exit(0);
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $registermsg = "Email is not valid!";
                $_SESSION['message'] = $registermsg;
                header("Location: ../login/register.php");
                exit(0);
            } else {
                $query = "INSERT INTO users(email, username, password, role) VALUES('$email', '$username', '$hash', 'user')";
                try {
                    $this->db->query($query);
                } catch (Exception $e) {
                    return false;
                }

                $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hash' AND email = '$email'";
                $result = $this->db->query($sql);
                if ($result) {
                    $value = $result->fetch_assoc();
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $value['username'];
                    $_SESSION['id'] = $value['id'];
                    $_SESSION['time'] = time() + 3600;
                    $_SESSION['role'] = "user";
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}

?>