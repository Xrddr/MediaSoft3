<?php require_once "auth.php"
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MediaSoft</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<div>
<form action="./" method="post">
    <label>Имя</label>
    <input name="name" placeholder="Введите своё имя">
    <label>Фамилия</label>
    <input name="surname" placeholder="Введите свою фамилию">
    <label>Логин</label>
    <input name="login" placeholder="Введите логин">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <button type="submit">Зарегистрироваться</button>
</form>
    <div align="center">
    <?php $validate = valid($_POST)?>
    <?php if (!empty($validate['error']) and $validate['error']): ?>
        <?php foreach ($validate['messages'] as $message): ?>
            <p style="color: red">
                <?= $message ?>
            </p>
        <?php endforeach;  ?>
    <?php endif;?>
    <?php if (!empty($validate['success']) and $validate['success']):?>
        <?php foreach ($validate['messages'] as $message):?>
            <p style="color: green">
                <?= $message ?>
            </p>
        <?php endforeach;?>
    <?php endif;?>
</div>
</div>
</body>
</html>