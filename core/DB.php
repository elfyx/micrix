<?php

namespace Core;

use Services\DataBase;

abstract class DB
{
    /**
     * @var DataBase
     */
    protected static $db;

    /**
     * Получить объект Базы данных
     *
     * @return DataBase
     */
    public static function get()
    {
        if (is_null(self::$db)) {
            self::$db = new DataBase(include __DIR__ . '/../config/db.php');
        }

        return self::$db;
    }
}
