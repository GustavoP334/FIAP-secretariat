<?php

namespace App\Controllers;

require_once __DIR__ . '/../Helpers/view.php';

class HomeController 
{
    public function index() 
    {
        view('home', [
            'title' => 'Início',
            'data' => []
        ]);
    }
}
