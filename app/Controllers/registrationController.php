<?php

namespace App\Controllers;

use App\Services\RegistrationService;
use App\Services\StudentsService;

require_once __DIR__ . '/../Helpers/view.php';

class RegistrationController extends Controller
{
    protected RegistrationService $registrationService;
    protected StudentsService $studentsService;

    public function __construct()
    {
        $this->registrationService = new RegistrationService();
        $this->studentsService = new StudentsService();
    }

    public function index() 
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $page = $_GET['page'] ?? 1;
        
        $data = $this->registrationService->index($search, $page);
        $students = $this->studentsService->getAllList();

        view('registration', [
            'title' => 'Matrículas',
            'data' => $data['data'],
            'students' => $students['data'],
            'paginate' => $data['paginate'],
            'perPage' => $data['perPage']
        ], 'registrations.js');
    }

    public function store()
    {
        $data = $this->registrationService->store($_POST);

        setFlashMessage($data['Message'], $data['Status']);

        $this->redirect('/matriculas');
    }

    public function delete($id, $student)
    {
        $data = $this->registrationService->delete($id, $student);

        setFlashMessage($data['Message'], $data['Status']);

        $this->redirect('/matriculas');
    }
}
