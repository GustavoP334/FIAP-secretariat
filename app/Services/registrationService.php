<?php

namespace App\Services;

use App\Models\RegistrationModel;

class RegistrationService
{
    protected RegistrationModel $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
    }

    public function index()
    {
        $dados = $this->registrationModel->getAll();

        return $dados;
    }
}