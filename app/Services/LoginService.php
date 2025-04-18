<?php

namespace App\Services;

use App\Enums\MessageTypes;
use App\Models\UsersModel;

require_once __DIR__ . '/../Helpers/session.php';

class LoginService extends Service
{
    protected UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function login($email, $password)
    {
        if($email == null || $password == null || $email == "" || $password == ""){
            return [
                'Message' => 'Preencha todos os campos.',
                'Status' => MessageTypes::ERROR
            ];
        }

        $user = $this->usersModel->getUser($email);

        if ($user['data'] == null) {
            return [
                'Message' => 'Esse email não existe na nossa base.',
                'Status' => MessageTypes::ERROR
            ];
        }

        if($this->verifyEncryptedPassword($password, $user['data']['password'])){
            logUser($user['data']['id'], $user['data']['name']);
            
            return true;
        } else {
            return [
                'Message' => 'Email ou senha incorretos.',
                'Status' => MessageTypes::ERROR
            ];
        }
    }
}