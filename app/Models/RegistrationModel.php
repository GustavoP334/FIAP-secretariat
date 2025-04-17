<?php

namespace App\Models;

use PDO;

class RegistrationModel extends Model
{
    protected $tableName = 'registrations';

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
        $this->validateColumnName($this->tableName);

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (student_id, class_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");

        return $stmt->execute([$data['student_id'], $data['class_id']]);
    }
}
