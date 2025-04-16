<?php

namespace App\Controllers;

use App\Services\StudentsService;

require_once __DIR__ . '/../Helpers/view.php';

class StudentsController
{
    protected StudentsService $studentsService;

    public function __construct()
    {
        $this->studentsService = new StudentsService();
    }

    public function index() 
    {
        $data = $this->studentsService->index();

        view('students', [
            'title' => 'Alunos',
            'data' => $data
        ], 'students.js');
    }

    public function store()
    {
        $data = $this->studentsService->store($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        header('Location: /alunos');
        exit;
    }
}
