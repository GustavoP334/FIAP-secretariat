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

    public function getAll(string $search, int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;
        
        $query = "SELECT id, name, email, document, birth_date FROM {$this->tableName}";
        
        if ($search !== '') {
            $query .= " WHERE name LIKE :search";
        }
    
        $query .= " LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($query);
        
        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
    
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        $stmt->execute();
        return [
            "data" => $stmt->fetchAll(PDO::FETCH_ASSOC),
            "paginate" => $this->countAll($search),
            "perPage" => $perPage
        ];
    }    

    private function countAll(string $search): int
    {
        $query = "SELECT COUNT(*) FROM {$this->tableName}";

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
            return $e;
        }
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = (?)");

        $stmt->execute([$id]);

        if ($stmt->rowCount() === 0) {
            return false;
        }

        return true;
    }
}
