<?php

namespace App\Models;

use PDO;

class ClassesModel extends Model
{
    protected $tableName = 'classes';

    public function getAll(string $search, int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;
        
        $query = "
            SELECT 
                classes.id, 
                classes.name, 
                classes.description, 
                classes.created_at, 
                COUNT(students.id) AS num_students
            FROM classes
            LEFT JOIN registrations ON registrations.class_id = classes.id
            LEFT JOIN students ON students.id = registrations.student_id
        ";

        if ($search !== '') {
            $query .= " WHERE classes.name LIKE :search";
        }

        $query .= "
            GROUP BY classes.id
            ORDER BY classes.name ASC
            LIMIT :limit OFFSET :offset
        ";
        
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

    public function new(array $data): bool
    {
        $this->validateColumnName($this->tableName);

        $stmt = $this->db->prepare("INSERT INTO {$this->tableName} (name, description, created_at, updated_at) VALUES (?, ?, NOW(), NOW())");

        return $stmt->execute([$data['name'], $data['description']]);
    }

    public function put(array $data)
    {
        $this->validateColumnName($this->tableName);

        $stmt = $this->db->prepare("UPDATE {$this->tableName} SET name = ?, description = ?, updated_at = NOW() WHERE id = ?");

        $stmt->execute([$data['name'], $data['description'], $data['id']]);

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