<?php


class PhoneBook
{


    public static function getPhones()
    {

        $db = DB::getConnection();

        $result = $db->query('SELECT * FROM all_phone_book ORDER BY id DESC');
        $phoneList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $phoneList[$i]['id'] = $row['id'];
            $phoneList[$i]['name'] = $row['name'];
            $phoneList[$i]['prefix'] = $row['prefix'];
            $phoneList[$i]['number'] = $row['number'];
            $phoneList[$i]['updated_at'] = $row['updated_at'];
            $i++;
        }
        return $phoneList;


    }


    public static function createPhone($prefix, $number, $name, $deleted)
    {
        $db = DB::getConnection();
        $time = date("Y-m-d H:i:s");


        if (!self::checkUnique($number)) {
            $sql = 'insert into all_phone_book (prefix,number,name,updated_at,deleted) values(:prefix,:number,:name,:updated_at,:deleted)';
            $result = $db->prepare($sql);
            $result->bindParam(':prefix', $prefix, PDO::PARAM_STR);
            $result->bindParam(':number', $number, PDO::PARAM_STR);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindValue(":updated_at", $time, PDO::PARAM_STR);
            $result->bindParam(':deleted', $deleted, PDO::PARAM_INT);

            if ($result->execute())
                return $db->lastInsertId();
        }
        return 0;
    }

    public static function updatePhone($id, $name, $prefix, $number)
    {
        $db = Db::getConnection();
        $time = date("Y-m-d H:i:s");


        $sql = "UPDATE all_phone_book
            SET 
                name = :name, 
                prefix = :prefix, 
                number = :number,
                updated_at = :updated_at
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':prefix', $prefix, PDO::PARAM_STR);
        $result->bindParam(':number', $number, PDO::PARAM_STR);
        $result->bindParam(':updated_at', $time, PDO::PARAM_STR);
        return $result->execute();


    }


    public static function deletePhone($id)
    {
        $db = DB::getConnection();

        $sql = 'DELETE FROM all_phone_book WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();

    }

    public static function checkUnique($number)
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM  all_phone_book WHERE number = :number';
        $result = $db->prepare($sql);
        $result->bindParam(':number', $number, PDO::PARAM_STR);
        $result->execute();
        $res = $result->fetchAll();
        if (!empty($res))
            return true;
        return false;
    }

    public static function searchClient($name)
    {
        $db = DB::getConnection();
        $sql = 'SELECT * FROM all_phone_book WHERE name = :name';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);

    }


}