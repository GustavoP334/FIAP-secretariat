<?php

namespace App\Models;

require_once __DIR__ . '/../../database/config.php';

use InvalidArgumentException;
use PDO;

class RegistrationModel
{
    protected PDO $db;
    protected $tableName = 'registrations';

    public function __construct()
    {
        $this->db = dbConnect();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM $this->tableName;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->tableName WHERE id = ?;");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function new(array $data): bool
    {
        if (empty($data['student_id']) || empty($data['class_id'])) {
            throw new InvalidArgumentException("Os campos turma e Aluno são obrigatórios.");
        }
    
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->tableName)) {
            throw new InvalidArgumentException("Nome da tabela é inválido.");
        }

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (student_id, class_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");

        return $stmt->execute([$data['student_id'], $data['class_id']]);
    }
}
