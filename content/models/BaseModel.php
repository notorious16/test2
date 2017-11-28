<?php class BaseModel
{
    public static $data;
    public static $sql;

    public static function db($sql)
    {
        if (isset($sql['execute'])) {
            $query = Framework::db()->prepare($sql['string']);
            $query->execute($sql['execute']);
        } else {
            $query = Framework::db()->query($sql['string']);
        }
        if ($sql['data']) return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}