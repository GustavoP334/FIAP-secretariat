<?php

namespace App\Services;

use App\Enums\MessageTypes;
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
    
    public function getAllList()
    {
        $dados = $this->studentsModel->getAllList();
        
        return $dados;
    }

    public function store($data)
    {
        $data['document'] = $this->formatDocument($data['document']);

        $this->validate($data);

        $data['password'] = $this->encryptPassword($data['password']);

        $execute = $this->studentsModel->new($data);

        if($execute === true){
            return [
                'Message' => 'Aluno cadastrado com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } elseif (is_string($execute)) {
            return [
                'Message' => $execute,
                'Status' => MessageTypes::ERROR
            ];
        } else {
            return [
                'Message' => "Erro ao cadastrar aluno.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }
    
    public function put($data)
    {
        $data['document'] = $this->formatDocument($data['document']);

        $this->validate($data);

        $execute = $this->studentsModel->put($data);

        if($execute){
            return [
                'Message' => 'Aluno atualizado com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } else {
            return [
                'Message' => "Erro ao atualizar aluno.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }

    public function delete($id)
    {
        $execute = $this->studentsModel->delete($id);

        if($execute){
            return [
                'Message' => 'Aluno deletado com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } else {
            return [
                'Message' => "Erro ao deletar aluno.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }

    private function formatDocument($document)
    {
        return str_replace(['.', '-'], '', $document);
    }

    private function validate($data)
    {
        if (in_array(null, $data, true) || in_array('', $data, true)) {
            return [
               'Message' => 'É necessário preencher todos os dados.',
               'Status' => MessageTypes::ERROR
           ];
       }

       if (strlen($data['name']) < 3 && strlen($data['document']) < 11 && !$this->verifyPassword($data['password'])) {
        return [
           'Message' => 'Os dados não seguiram o padrão de obrigatoriedade!',
           'Status' => MessageTypes::SUCCESS
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