<?php

function logUser($id, $email){
    $_SESSION['user'] = [
        'id' => $id,
        'name' => $email
    ];
}

function logout()
{
    session_destroy();
    header('Location: /login');
    exit;
}
