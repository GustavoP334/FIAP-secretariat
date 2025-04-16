<?php

namespace App\Models;

require_once __DIR__ . '/../../database/config.php';

use Exception;
use InvalidArgumentException;
use PDO;

class StudentsModel
{
    protected PDO $db;
    protected $tableName = 'students';

    public function __construct()
    {
        $this->db = dbConnect();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT id, name, email, document, birth_date FROM $this->tableName ORDER BY name ASC;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): array
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->tableName WHERE id = ?;");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function new(array $data)
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->tableName)) {
            throw new InvalidArgumentException("Nome da tabela é inválido.");
        }

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (name, document, birth_date, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");

        try {
            return $stmt->execute([$data['name'], $data['document'], $data['birth_date'], $data['email'], $data['password']]);
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                return "CPF ou e-mail já cadastrado.";
            }
            throw $e;
        }
    }
}
