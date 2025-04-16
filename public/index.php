<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../app/Helpers/messages.php';

$router->dispatch($_SERVER['REQUEST_URI']);
