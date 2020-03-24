<?php

namespace App\Models;

use Core\DB;

class Finance
{
    /**
     * Получить баланс текущего пользователя
     *
     * @param $userId int
     * @return string
     */
    public function getUserBalance(int $userId)
    {
        $db = DB::get();

        $balance = $db->selectOne('select * from finance where user_id = :user_id', [':user_id' => $userId]);
        $balance = (isset($balance))? $balance['balance']: 0;

        return $balance;
    }

    /**
     * Списать с баланса текущего пользователя
     *
     * @param $userId int
     * @param $summ string
     */
    public function transferUserBalance(int $userId, string $summ)
    {
        $db = DB::get();

        $summ = str_replace(',', '.', trim($summ));

        if (!$this->isValidMoney($summ)) {
            return;
        }

        $db->beginTransaction();

        $currentBalance = $db->selectOne('select * from finance where user_id = :user_id for update', [':user_id' => $userId]);
        $currentBalance = (isset($currentBalance))? $currentBalance['balance']: 0;

        $newBalance  = $currentBalance - $summ;

        if ($newBalance < 0) {
            $db->rollbacktTransaction();
            return;
        }

        $db->query('update finance set balance  = :balance where user_id = :user_id', [
            ':balance' => $newBalance,
            ':user_id' => $userId
        ]);
        $db->commitTransaction();
    }

    /**
     * Проверка формата денег
     *
     * @param $money string
     * @return bool
     */
    public function isValidMoney($money)
    {
        return preg_match("/^\d+\.?\d*$/", $money);
    }
}