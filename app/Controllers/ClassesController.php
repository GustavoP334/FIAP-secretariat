<?php

namespace App\Controllers;

use App\Services\ClassesService;

require_once __DIR__ . '/../Helpers/view.php';

class ClassesController extends Controller
{
    protected ClassesService $classesService;

    public function __construct()
    {
        $this->classesService = new ClassesService();
    }

    public function index()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = $_GET['page'] ?? 1;

        $data = $this->classesService->index($search, (int)$page);

        view('classes', [
            'title' => 'Turmas',
            'data' => $data['data'],
            'paginate' => $data['paginate'],
            'perPage' => $data['perPage']
        ], 'classes.js');
    }

    public function store()
    {
        $data = $this->classesService->store($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        $this->redirect('/turmas');
    }
    
    public function put()
    {
        $data = $this->classesService->put($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        $this->redirect('/turmas');
    }

    public function delete($id)
    {
        $data = $this->classesService->delete($id);

        setFlashMessage($data['Message'], $data['Status']);

        $this->redirect('/turmas');
    }
}