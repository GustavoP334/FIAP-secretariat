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
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = $_GET['page'] ?? 1;

        $data = $this->studentsService->index($search, (int)$page);

        view('students', [
            'title' => 'Alunos',
            'data' => $data['data'],
            'paginate' => $data['paginate'],
            'perPage' => $data['perPage']
        ], 'students.js');
    }

    public function store()
    {
        $data = $this->studentsService->store($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        header('Location: /alunos');
        exit;
    }
    
    public function put()
    {
        $data = $this->studentsService->put($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        header('Location: /alunos');
        exit;
    }

    public function delete($id)
    {
        $data = $this->studentsService->delete($id);

        setFlashMessage($data['Message'], $data['Status']);

        header('Location: /alunos');
        exit;
    }
}
