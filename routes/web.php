<?php

use App\Controllers\HomeController;
use App\Controllers\RegistrationController;
use App\Controllers\StudentsController;

/** @var \App\Core\Router $router */

$router->get('/inicio', [HomeController::class, 'index']);
$router->get('/matriculas', [RegistrationController::class, 'index']);
$router->get('/alunos', [StudentsController::class, 'index']);
$router->post('/alunos/store', [StudentsController::class, 'store']);
