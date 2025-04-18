<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Services\LoginService;

require_once __DIR__ . '/../Helpers/view.php';
require_once __DIR__ . '/../Helpers/session.php';

class LoginController extends Controller
{
    protected LoginService $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }
    public function index() 
    {
        Auth::redirectIfLoggedIn();
        
        view('login', [
            'title' => 'Login',
            'data' => [],
            'js' => 'login.js',
            'css' => 'login.css',
        ]);
    }

    public function login()
    {
        $data = $this->loginService->login($_POST['email'], $_POST['password']);

        if(is_array($data)){
            setFlashMessage($data['Message'], $data['Status']);

            $this->redirect('/login');
        }
        
        $this->redirect('/inicio');
    }

    public function logout()
    {
        logout();
    }
}
