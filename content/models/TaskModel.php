<?php

class TaskModel extends BaseModel
{
    public static function redImg()
    {
        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
        } else {
            return self::$data['error'] = 'Возможно атака через загрузку файла';
//            self::renderView('params1', ['error' => self::$data['error']]);
        }
        self::$data['name'] = $_POST['name'];
        self::$data['email'] = $_POST['email'];
        self::$data['textarea'] = $_POST['textarea'];

        Framework::useModel('upload');
        $foo = new uploadModel($_FILES['userfile']['tmp_name']);
        if ($foo->uploaded) {
            // save uploaded image with a new name,
            // resized to 100px wide
            $foo->file_new_name_body = 'image_resized';
            $foo->image_resize = true;
            $foo->image_convert = gif;
            $foo->image_x = 320;
            $foo->image_ratio_y = true;
            $foo->Process(Framework::$dirName . '/img/');
            if ($foo->processed) {
                self::$data['imgUrl'] = $foo->file_dst_name;
//                echo '<br><img  align="center" src="/img/' . $foo->file_dst_name . '">';
                $foo->Clean();
                self::saveTask();
            } else self::$data['imgUrl'] = 'ERROR';
        }
        return self::$data;
    }

    public static function saveTask()
    {
        self::$sql['string']  = 'INSERT INTO data(name, email, textarea, url) VALUE (:name, :email, :textarea, :url)';
        self::$sql['execute'] = [
            ':name'     => self::$data['name'],
            ':email'    => self::$data['email'],
            ':textarea' => self::$data['textarea'],
            ':url'      => self::$data['imgUrl']
        ];
        self::$sql['data'] = false;
        self::db(self::$sql);
    }
    
    public static function getTasks(){
        self::$sql['string'] = 'SELECT * FROM data';
        self::$sql['data'] = true;
        return self::db(self::$sql);
    }
}