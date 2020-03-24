<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Micrix</title>
</head>
<body>
<div id="headr">
    <?php if (\Core\Auth::isLogin()): ?>
        <?php echo \Core\Auth::fetchUser()['login'] ?>
        <a href="/logout">Выход</a>
    <?php endif; ?>
</div>
<div id="content">
