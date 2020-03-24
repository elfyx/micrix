<?php

return [
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'micrix',
    'username' => 'micrix',
    'password' => 'micrix',
    'charset'  =>  'utf8',
    'options'  => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
