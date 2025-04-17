<?php

namespace App\Controllers;

use App\Services\RegistrationService;

require_once __DIR__ . '/../Helpers/view.php';

class RegistrationController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct()
    {
        $this->registrationService = new RegistrationService();
    }

    public function index() 
    {
        $data = $this->registrationService->index();

        view('registration', [
            'title' => 'Matrículas',
            'data' => $data
        ]);
    }
}
