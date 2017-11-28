<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>enter</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="login center-block">
            <form method="POST" action="/enter/testreg">
                <label for="login">Введите ваш Логин</label>
                <input name="login" id="login" type="text" size="15" maxlength="15">
                <label for="password">Введите ваш Пароль</label>
                <input name="password" id="password" type="password" size="15" maxlength="15">
                <input type="submit" name="submit" class="btn btn-success" value="Войти">
            </form>
        </div>
    </div>
</div>
</body>
</html>