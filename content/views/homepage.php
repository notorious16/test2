<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <link rel="stylesheet" href="../../css/style.css" >
    <link rel="stylesheet" href="../../css/bootstrap.css" >
</head>
<body>
<div class="container">
    <div class="row">
        <div class="main">
            <div class="msg_admin">
                <?php if (isset($_SESSION['admin']) and !empty($_SESSION['admin'])) echo "Вы вошли как " . $_SESSION['admin'] . "."?>
            </div>
        <b>Главная страница<b> <br>
        <br>
        <a href="/ex" class="btn btn-default">Создать задачу</a>
        <a href="/enter" class="btn btn-default">Войти</a>
        <a href="/main/exit">Выйти</a>
        <a href="/change/edit/?id=джаваскриптом вставляю айдишник таска">Выйти</a>
            <?php foreach ($data as $key => $task):?>
                <div class="tasks">
                    <?php if(isset($task['name']) and !empty($task['name'])) echo 'Имя:'. $task['name']. '<br>'?>
                    <?php if(isset($task['email']) and !empty($task['email'])) echo 'Имейл:'. $task['email']. '<br>'?>
                    <?php if(isset($task['textarea']) and !empty($task['textarea'])) echo 'Текст:'. $task['textarea']. '<br>'?>
                    <?php if(isset($task['url']) and !empty($task['url']) and $task['url'] != 'ERROR'):?>
                    <br><img  align="center" src="/img/<?php echo $task['url']?>">
                    <?php endif?>

                </div><hr>
            <?php endforeach?>
        </div>
    </div>
</div>
</body>
</html>