<?php


class ModelNumber
{

    private $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getDate($cache)
    {
        $sql = 'SELECT numbers FROM number WHERE cache=:cache';
        $sth = $this->db->prepare($sql);
        $sth->execute([':cache' => $cache]);
        $res = $sth->fetchAll();
        return $res[0]['numbers'];
    }

    public function create($cache)
    {
        $number = $this->fib($cache);
        $sql = 'INSERT INTO `number` (`numbers`, `cache`)'.'VALUES (:numbers, :cache);';
        $result = $this->db->prepare($sql);
        $result->bindParam(':numbers', $number, PDO::PARAM_INT);
        $result->bindParam(':cache', $cache, PDO::PARAM_INT);
        $result->execute();

        return $number;
    }

    public function checkCache($cache)
    {
        $sql = 'SELECT * FROM number WHERE cache=:cache';
        $sth = $this->db->prepare($sql);
        $sth->execute([':cache' => $cache]);

        $res = $sth->fetchAll();
        if(! empty($res)) return true;

        return false;

    }

    public function fib($n)
    {
        $result = [1, 1];

        for($i = 2; $i <= $n; $i++ ) {
            $result[] = $result[$i-1] + $result[$i-2];
        }

        return $result[count($result)-2];
    }

}