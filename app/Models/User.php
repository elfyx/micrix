<?php

namespace App\Models;

use Core\DB;
use Core\Auth;

class User
{
    public function login(string $login, string $password)
    {
        $db = DB::get();

        $login = trim($login);
        $password = trim($password);

        if (!$this->isValidLogin($login) || !$this->isValidPassword($password)) {
            return false;
        }

        $user = $db->selectOne('select * from users where login = :login', [':login' => $login]);
        if (is_null($user)) {
            return false;
        }

        if ($user['password'] != $password) {
            return false;
        }

        Auth::login($user['id']);

        return true;
    }

    /**
     * Проверка логина
     *
     * @param $login string
     * @return bool
     */
    public function isValidLogin($login)
    {
        return preg_match("/^[A-Za-z\d\-_]{4,20}$/", $login);
    }

    /**
     * Проверка пароля
     *
     * @param $password string
     * @return bool
     */
    public function isValidPassword($password)
    {
        return preg_match("/^[A-Za-z\d\-_]{3,32}$/", $password);
    }
}