<?php

namespace App\Services;

use App\Models\StudentsModel;

class StudentsService
{
    protected StudentsModel $studentsModel;

    public function __construct()
    {
        $this->studentsModel = new StudentsModel();
    }

    public function index()
    {
        $dados = $this->studentsModel->getAll();

        return $dados;
    }

    public function store($data)
    {
        $passwordVerify = $this->verifyPassword($data['password']);

        if ((in_array(null, $data, true) || in_array('', $data, true)) && $passwordVerify) {
            return false;
        }
        
        var_dump($data);
    }

    function verifyPassword($password) {
        $minCaracteres = strlen($password) >= 8;
    
        $hasTiny = preg_match('/[A-Z]/', $password);
    
        $hasCapital = preg_match('/[a-z]/', $password);
    
        $hasNumber = preg_match('/\d/', $password);
    
        $hasSimbol = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
    
        if ($minCaracteres && $hasTiny && $hasCapital && $hasNumber && $hasSimbol) {
            return true;
        }
    
        return false;
    }
}