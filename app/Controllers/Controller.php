<?php

namespace App\Controllers;

class Controller
{
    protected function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }
}
