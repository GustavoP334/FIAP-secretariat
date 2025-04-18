<?php

namespace App\Controllers;

use App\Core\Auth;

class Controller
{
    public function __construct()
    {
        Auth::check();
    }

    protected function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }
}
