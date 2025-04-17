<?php

namespace App\Services;

use App\Enums\MessageTypes;
use App\Models\RegistrationModel;

class RegistrationService
{
    protected RegistrationModel $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
    }

    public function index($search = '', int $page)
    {
        $dados = $this->registrationModel->getAll($search, $page);
        
        return $dados;
    }

    public function store($data)
    {
        $execute = $this->registrationModel->new((int) $data['id'], $data['selectStudent']);

        if($execute === true){
            return [
                'Message' => 'Aluno(s) matriculado(s) com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } elseif (is_string($execute)) {
            return [
                'Message' => $execute,
                'Status' => MessageTypes::ERROR
            ];
        } else {
            return [
                'Message' => "Erro ao matricular aluno(s).",
                'Status' => MessageTypes::ERROR
            ];
        }
    }

    public function delete($id, $student)
    {
        $execute = $this->registrationModel->delete($id, $student);

        if($execute){
            return [
                'Message' => 'Matrícula do aluno removida com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } else {
            return [
                'Message' => "Erro ao remover matrícula do aluno.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }
}