<?php

namespace App\Core;

class Auth
{
    public static function check()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function redirectIfLoggedIn()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /inicio');
            exit;
        }
    }
}
