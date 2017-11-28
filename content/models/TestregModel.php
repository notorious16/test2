<?php

class TestregModel extends BaseModel
{
    public static function testAdm()
    {
        if (isset($_POST['login'])) {
            $login = $_POST['login'];
            if ($login == '') {
                unset($login);
            }
        }
        if (isset($_POST['password'])) {
            $password = $_POST['password'];
            if ($password == '') {
                unset($password);
            }
        }
        if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        $login = htmlspecialchars($login);
        $password = htmlspecialchars($password);

        self::$sql['string'] = "SELECT * FROM my_users WHERE login=:login AND password=:password";
        self::$sql['execute'] = [
            ':login' => $login,
            ':password' => $password
        ];
        self::$sql['data'] = true;
        return self::db(self::$sql);
//        foreach ($data1 as $key => $value) {
//
////        $link = mysqli_connect($host, $user, $password1, $database)
////        or die("Ошибка " . mysqli_error($link));
////        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
////        $myrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
//            if (empty($value['password'])) {
//                exit ("Извините, введённый вами login или пароль неверный.");
//            } else {
//                if ($value['password'] == $password) {
//                    $_SESSION['login'] = $value['login'];
//                    $_SESSION['id'] = $value['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
//                    echo "Вы успешно вошли на сайт как " . $value['login'] . '.';
//                } else {
//                    exit ("Извините, введённый вами login или пароль неверный.");
//                }
//            }
//        }
//        return $data1;
    }
}