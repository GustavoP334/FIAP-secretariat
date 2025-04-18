<?php

namespace App\Services;

class Service
{
    public function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyEncryptedPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }
}