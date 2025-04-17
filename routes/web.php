<?php

use App\Controllers\ClassesController;
use App\Controllers\HomeController;
use App\Controllers\RegistrationController;
use App\Controllers\StudentsController;

/** @var \App\Core\Router $router */

$router->get('/inicio', [HomeController::class, 'index']);
$router->get('/matriculas', [RegistrationController::class, 'index']);

$router->get('/alunos', [StudentsController::class, 'index']);
$router->post('/alunos/store', [StudentsController::class, 'store']);
$router->put('/alunos/store', [StudentsController::class, 'put']);
$router->delete('/alunos/{id}', [StudentsController::class, 'delete']);

$router->get('/turmas', [ClassesController::class, 'index']);
$router->post('/turmas/store', [ClassesController::class, 'store']);
$router->put('/turmas/store', [ClassesController::class, 'put']);
$router->delete('/turmas/{id}', [ClassesController::class, 'delete']);