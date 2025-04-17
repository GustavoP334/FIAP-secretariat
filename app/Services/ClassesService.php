<?php

namespace App\Services;

use App\Enums\MessageTypes;
use App\Models\ClassesModel;

class ClassesService
{
    protected ClassesModel $classesModel;

    public function __construct()
    {
        $this->classesModel = new ClassesModel();
    }

    public function index($search = '', int $page)
    {
        $dados = $this->classesModel->getAll($search, $page);
        
        return $dados;
    }

    public function store($data)
    {
        $execute = $this->classesModel->new($data);

        if($execute === true){
            return [
                'Message' => 'Turma cadastrada com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } elseif (is_string($execute)) {
            return [
                'Message' => $execute,
                'Status' => MessageTypes::ERROR
            ];
        } else {
            return [
                'Message' => "Erro ao cadastrar turma.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }
    
    public function put($data)
    {
        $execute = $this->classesModel->put($data);

        if($execute){
            return [
                'Message' => 'Turma atualizada com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } else {
            return [
                'Message' => "Erro ao atualizar turma.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }

    public function delete($id)
    {
        $execute = $this->classesModel->delete($id);

        if($execute){
            return [
                'Message' => 'Turma deletada com sucesso!',
                'Status' => MessageTypes::SUCCESS
            ];
        } else {
            return [
                'Message' => "Erro ao deletar turma.",
                'Status' => MessageTypes::ERROR
            ];
        }
    }
}