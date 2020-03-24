<?php

namespace Services;

class DataBase
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * Конструктор
     *
     * @param array $config Массив с настройками
     */
    public function __construct(array $config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        $this->pdo = new \PDO($dsn, $config['username'], $config['password'], $config['options']);
    }

    /**
     * Привязать параметры
     *
     * @param \PDOStatement $statement
     * @param array $parameters
     */
    protected function bindParameters(\PDOStatement $statement, array $parameters)
    {
        foreach ($parameters as $key => $value) {
            $nameParam = is_string($key) ? $key : $key + 1;
            $pdoType = is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR;
            $statement->bindValue($nameParam, $value, $pdoType);
        }
    }

    /**
     * Выполнить запрос
     *
     * @param string $query
     * @param array $parameters
     *
     * @return \PDOStatement
     */
    protected function exeQuery(string $query, array $parameters = [])
    {
        $statement = $this->pdo->prepare($query);
        $this->bindParameters($statement, $parameters);
        $statement->execute();

        return $statement;
    }

    /**
     * Выполнить запрос и вернуть набор строк
     *
     * @param string $query
     * @param array $parameters
     *
     * @return array
     */
    public function select(string $query, array $parameters = [])
    {
        $statement = $this->exeQuery($query, $parameters);

        return $statement->fetchAll();
    }

    /**
     * Выполнить запрос и одну строку
     *
     * @param string $query
     * @param array $parameters
     *
     * @return array
     */
    public function selectOne(string $query, array $parameters = [])
    {
        $statement = $this->exeQuery($query, $parameters);
        $result = $statement->fetchAll();
        return (count($result) > 0)? $result[0]: null;
    }

    /**
     * Выполнить запрос и количество строк
     *
     * @param string $query
     * @param array $parameters
     *
     * @return int
     */
    public function query(string $query, array $parameters = [])
    {
        $statement = $this->exeQuery($query, $parameters);

        return $statement->rowCount();
    }

    /**
     * Начать транзакцию
     */
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    /**
     * Завершить транзакцию
     */
    public function commitTransaction()
    {
        $this->pdo->commit();
    }

    /**
     * Откатить транзакцию
     */
    public function rollbacktTransaction()
    {
        $this->pdo->rollBack();
    }
}
