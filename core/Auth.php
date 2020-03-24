<?php

namespace Core;

abstract class Auth
{
    /**
     * @var array
     */
    protected static $user;

    /**
     * Получить аутонтефицированного пользователя
     *
     * @return array | null
     */
    public static function fetchUser()
    {
        if (isset(self::$user)) {
            return self::$user;
        }

        session_start();
        $user_id = isset($_SESSION['user_id'])? $_SESSION['user_id']: null;
        session_write_close();

        if (isset($user_id)) {
            self::$user = DB::get()->selectOne('select * from users where id = :id', [':id' => (int)$user_id]);
        }

        return self::$user;
    }

    /**
     * Узнать залогинен ли пользователь
     *
     * @return bool
     */
    public static function isLogin()
    {
        return !is_null(self::fetchUser());
    }

    /**
     * Залогинить пользователя
     *
     * @param $userId
     */
    public static function login($userId)
    {
        session_start();
        $_SESSION['user_id'] = $userId;
        session_write_close();
    }

    /**
     * Разлогинить
     */
    public static function logout()
    {
        session_start();
        unset($_SESSION['user_id']);
        session_write_close();
    }
}
