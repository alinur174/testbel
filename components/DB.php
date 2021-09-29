<?php


class DB
{
    public static $DBHOST = 'localhost';
    public static $DBNAME = 'admin_new';
    public static $DBUSER = 'John' ;
    public static $DBPASS = '';

    public static function getConnection()
    {

        try {
            return new PDO('mysql: host=localhost;dbname=admin_new;port=33061','root','');
               // self::$DBNAME.';charset=utf8','port=33061', self::$DBUSER, self::$DBPASS);

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