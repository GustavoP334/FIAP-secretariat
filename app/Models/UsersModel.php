<?php

namespace App\Models;

use PDO;

class UsersModel extends Model
{
    protected $tableName = 'users';

    public function getUser($email): array
    {
        $query = "SELECT id, name, password FROM {$this->tableName} WHERE email = (?)";
        
        $stmt = $this->db->prepare($query);
    
        $stmt->execute([$email]);
        return [
            "data" => $stmt->fetch(PDO::FETCH_ASSOC)
        ];
    }
}