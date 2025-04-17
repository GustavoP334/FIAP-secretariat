<?php

namespace App\Models;

use PDO;

class RegistrationModel extends Model
{
    protected $tableName = 'registrations';

    public function getAll(string $search, int $page = 1, int $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;
        
        $query = "
            SELECT 
                classes.id, 
                classes.name, 
                COUNT(students.id) AS num_students,
                classes.created_at, 
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'id', students.id,
                        'name', students.name,
                        'document', students.document,
                        'registered_at', registrations.created_at
                    )
                ) AS students
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
            "paginate" => $this->countAllRegistrations($search),
            "perPage" => $perPage
        ];
    }

    public function countAllRegistrations(string $search): int
    {
        $query = "SELECT COUNT(DISTINCT classes.id) as total
                  FROM classes
                  LEFT JOIN registrations ON registrations.class_id = classes.id
                  LEFT JOIN students ON students.id = registrations.student_id";
    
        if ($search !== '') {
            $query .= " WHERE classes.name LIKE :search";
        }
    
        $stmt = $this->db->prepare($query);
    
        if ($search !== '') {
            $stmt->bindValue(':search', '%' . $search . '%');
        }
    
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return (int) ($result['total'] ?? 0);
    }
    
    public function new(int $classId, array $students): bool
    {
        $this->validateColumnName($this->tableName);

        $placeholders = [];
        $values = [];
    
        foreach ($students as $row) {
            $placeholders[] = "(?, ?, NOW(), NOW())";
            $values[] = $row;
            $values[] = $classId;
        }
    
        //insert ignore para quando houver duplicadas
        $sql = "INSERT IGNORE INTO {$this->tableName} (student_id, class_id, created_at, updated_at) VALUES " . implode(',', $placeholders);
    
        $this->db->beginTransaction();
        $stmt = $this->db->prepare($sql);
        $success = $stmt->execute($values);
    
        if ($success) {
            $this->db->commit();
            return true;
        }
    
        $this->db->rollBack();
        return false;
    }

    public function delete($id, $student)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE student_id = (?) AND class_id = (?)");

        $stmt->execute([$student, $id]);

        if ($stmt->rowCount() === 0) {
            return false;
        }

        return true;
    }
}
