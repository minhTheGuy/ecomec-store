<?php

class Session
{
    public static function init()
    {
        if (session_id() == '') {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("login") == false) {
            self::destroy();
        }
    }

    public static function checkLogin()
    {
        self::init();
        if (self::get("login") == true && self::get("role") == "admin") {
            header("Location: http://localhost/webapp/admin/adminPage.php");
        } else if (self::get("login") == true && self::get("role") == "user") {
            header("Location: http://localhost/webapp/users/userPage.php");
        }
    }
}
