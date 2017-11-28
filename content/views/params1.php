<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Exercises</title>
</head>
<body>
<div class="container" style="text-align: center">
    <div class="row">
        <?php if(isset($error) and !empty($error)) echo $error ?>
        <?php if(isset($name) and !empty($name)) echo 'Имя:'. $name. '<br>'?>
        <?php if(isset($mail) and !empty($mail)) echo 'Имейл:'. $mail. '<br>'?>
        <?php if(isset($textarea) and !empty($textarea)) echo 'Текст:'. $textarea. '<br>'?>
        <?php if(isset($imgUrl) and !empty($imgUrl) and $imgUrl != 'ERROR'):?>
        <br><img  align="center" src="/img/<?php echo $imgUrl?>">
        <?php else:?>
            Ошибка
        <?php endif?>
    </div>
</div>
</body>
</html>


