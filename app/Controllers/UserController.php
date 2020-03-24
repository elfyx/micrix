<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Вход пользователя
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            if ($user->login($_POST['login'], $_POST['password'])) {
                $this->redirect('/');
                return;
            };
        }

        return $this->viev->render('login');
    }

    /**
     * Выход пользователя
     */
    public function logout()
    {
        \Core\Auth::logout();
        $this->redirect('/login');
    }
}