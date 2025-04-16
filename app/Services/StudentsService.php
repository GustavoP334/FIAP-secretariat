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

    public function index($search = '', int $page)
    {
        $dados = $this->studentsModel->getAll($search, $page);
        
        return $dados;
    }

    public function store($data)
    {
        if (in_array(null, $data, true) || in_array('', $data, true)) {
            return false;
        }
        
        $data['document'] = str_replace(['.', '-'], '', $data['document']);

        if (strlen($data['name']) < 3 && strlen($data['document']) < 11 && !$this->verifyPassword($data['password'])) {
            return false;
        }

        $data['password'] = $this->encryptPassword($data['password']);

        $execute = $this->studentsModel->new($data);

        if($execute === true){
            return [
                'Message' => 'Aluno cadastrado com sucesso!',
                'Status' => 'Success'
            ];
        } elseif (is_string($execute)) {
            return [
                'Message' => $execute,
                'Status' => 'Error'
            ];
        } else {
            return [
                'Message' => "Erro ao cadastrar aluno.",
                'Status' => 'Error'
            ];
        }
    }

    public function delete($id)
    {
        $execute = $this->studentsModel->delete($id);

        if($execute){
            return [
                'Message' => 'Aluno deletado com sucesso!',
                'Status' => 'Success'
            ];
        } else {
            return [
                'Message' => "Erro ao deletar aluno.",
                'Status' => 'Error'
            ];
        }
    }

    private function verifyPassword($password) {
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

    private function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}