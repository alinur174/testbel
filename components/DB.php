<?php


class DB
{
    public static $DBHOST = 'localhost';
    public static $DBNAME = 'admin_new';
    public static $DBUSER = 'root';
    public static $DBPASS = 'root';

    public static function getConnection()
    {

        try {
            return new PDO('mysql:host=localhost;dbname=admin_new', self::$DBUSER, self::$DBPASS);

        } catch (PDOException $e) {

            var_dump(' подключиться к MySQL не получилось', 1);
            var_dump(' проверьте настройки в коде');
            var_dump("Error: " . $e->getMessage());
            //  exit();
        }
    }

}