<?php


class DB
{
    public static $DBHOST = 'localhost';
    public static $DBNAME = 'fibonacci';
    public static $DBUSER = 'root' ;
    public static $DBPASS = '';

    public static function getConnection()
    {

        try {
            return new PDO("mysql:host=". self::$DBHOST .";dbname=".
                self::$DBNAME.';charset=utf8', self::$DBUSER, self::$DBPASS);

        }
        catch(PDOException $e)
        {

            var_dump(' подключиться к MySQL не получилось', 1);
            var_dump(' проверьте настройки в коде');
            var_dump("Error: ".$e->getMessage());
            //  exit();
        }
    }

}