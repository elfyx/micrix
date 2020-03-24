<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Finance;
use Core\Auth;

class FinanceController extends BaseController
{
    protected $onlyLogin = true;

    /**
     * Страница управления средствами
     */
    public function index()
    {
        $user = Auth::fetchUser();
        $finance = new Finance();

        $currentBalance = $finance->getUserBalance($user['id']);

        return $this->viev->render('finance', [
            'currentBalance' => $currentBalance
        ]);
    }

    /**
     * Списать средства
     */
    public function transfer()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = Auth::fetchUser();
            $finance = new Finance();
            $finance->transferUserBalance($user['id'], $_POST['transfer_balance']);
        }
        $this->redirect('/');
    }
}