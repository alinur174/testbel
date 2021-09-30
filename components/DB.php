<?php


class DB
{
    public static $DBHOST = 'localhost';
    public static $DBNAME = 'admin_new';
    public static $DBUSER = 'root';
    public static $DBPASS = '';

    public static function getConnection()
    {

        try {
            return new PDO('mysql:host=localhost;port=33061;dbname=admin_new', self::$DBUSER, self::$DBPASS);

        } catch (PDOException $e) {
            var_dump("Error: " . $e->getMessage());
            //  exit();
        }
    }

}