<?php

namespace vendor\core;


class Db
{
    protected static $instance;
    protected $connect;

    protected function __construct()
    {
        $db = require ROOT . '/config/db_config.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,

        ];
        $dsn = "mysql:host={$db['host']};dbname={$db['dbname']}";
        $this->connect = new \PDO($dsn, $db['user'], $db['password'], $options);
    }

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }


    public function execute($sql, $params = [])
    {
        $stmt = $this->connect->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connect->prepare($sql);
        $res = $stmt->execute($params);
        if (!$res) {
            
            throw new \Exception;
            
        }
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

}