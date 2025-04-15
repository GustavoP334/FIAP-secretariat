<?php

namespace App\Controllers;

use App\Services\registrationService;

class registrationController 
{
    protected registrationService $registrationService;

    public function __construct()
    {
        $this->registrationService = new registrationService();
    }

    public function index() 
    {
        return $this->registrationService->index();
    }
}
