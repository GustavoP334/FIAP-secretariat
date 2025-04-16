<?php

namespace App\Models;

require_once __DIR__ . '/../../database/config.php';

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
        $stmt = $this->db->query("SELECT * FROM $this->tableName ORDER BY name ASC;");
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
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->tableName)) {
            throw new InvalidArgumentException("Nome da tabela é inválido.");
        }

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (name, document, birth_date, email, password, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");

        return $stmt->execute([$data['name'], $data['document'], $data['birth_date'], $data['email'], $data['password']]);
    }
}
