<h2>Управление средствами</h2>

<div>
    Текущий баланс: <?php echo $currentBalance ?>
</div>

<form method="POST" action="/transfer">
    <div>
        <label for="transfer_balance">Вывод средств</label>
        <input id="transfer_balance" type="text" name="transfer_balance" value="">
    </div>

    <button type="submit">Вывод</button>
</form>