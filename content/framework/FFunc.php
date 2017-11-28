<?php class FFunc
{
    public static function clearStr($str)
    {
        return trim(htmlspecialchars(strip_tags($str)));
    }

    public static function deleteAllSpaces($str)
    {
        $str = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $str);
        $str = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $str);
        return $str;
    }
}