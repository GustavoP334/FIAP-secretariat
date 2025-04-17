<?php

namespace App\Models;

require_once __DIR__ . '/../../database/config.php';

use InvalidArgumentException;
use PDO;

class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = dbConnect();
    }

    public function countAll(string $search, string $tableName): int
    {
        $query = "SELECT COUNT(*) FROM $tableName";

        if ($search !== '') {
            $query .= " WHERE name LIKE :search";
        }

        $stmt = $this->db->prepare($query);

        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%');
        }

        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function validateColumnName($tableName)
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            throw new InvalidArgumentException("Nome da tabela é inválido.");
        }
    }
}
