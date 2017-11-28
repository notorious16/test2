<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Exercises</title>
</head>
<body>
<div class="container" style="text-align: center">
    <div class="row">
<?php

define('ROOT', dirname(__FILE__));
$upfile = ROOT . '/uploads/' . $_FILES['userfile']['name'];
if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
        echo 'Невозможно переместить файл в каталог назначения';
        die();
    }
} else {
    echo 'Возможно атака через загрузку файла';
    die();
}
echo 'Имя:'. $_POST['name']. '<br>';
echo 'Имейл:' . $_POST['email']. '<br>';
echo $_POST['textarea'];
include ROOT . '/upload.php';
$foo = new upload(ROOT . '/uploads/' . $_FILES['userfile']['name']);
if ($foo->uploaded) {
    // save uploaded image with a new name,
    // resized to 100px wide
    $foo->file_new_name_body = 'image_resized';
    $foo->image_resize = true;
    $foo->image_convert = gif;
    $foo->image_x = 320;
    $foo->image_ratio_y = true;
    $foo->Process(ROOT . '/../../img/');
    if ($foo->processed) {
        echo '<br><img  align="center" src="/img/' . $foo->file_dst_name . '">';
        $foo->Clean();
    } else {
        echo 'error : ' . $foo->error;
    }
}
?>
    </div>
</div>
</body>
</html>


