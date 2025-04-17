<?php

namespace App\Models;

use PDO;

class StudentsModel extends Model
{
    protected $tableName = 'students';

    public function getAllList(): array
    {
        $query = "SELECT id, name, document FROM {$this->tableName}";
    
        $query .= " ORDER BY name ASC";
        
        $stmt = $this->db->prepare($query);
    
        $stmt->execute();
        return [
            "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)
        ];
    }   

    public function getAll(string $search, int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;
        
        $query = "SELECT id, name, email, document, birth_date FROM {$this->tableName}";
        
        if ($search !== '') {
            $query .= " WHERE name LIKE :search";
        }
    
        $query .= " ORDER BY name ASC";

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
            "paginate" => $this->countAll($search, $this->tableName),
            "perPage" => $perPage
        ];
    }    

    public function new(array $data)
    {
        $this->validateColumnName($this->tableName);

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

    public function put(array $data)
    {
        $this->validateColumnName($this->tableName);

        $stmt = $this->db->prepare("UPDATE {$this->tableName} SET name = ?, document = ?, birth_date = ?, email = ?, updated_at = NOW() WHERE id = ?");

        $stmt->execute([$data['name'], $data['document'], $data['birth_date'], $data['email'], $data['id']]);

        if ($stmt->rowCount() === 0) {
            return false;
        }

        return true;
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
