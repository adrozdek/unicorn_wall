<?php

namespace App\Core;

use PDO;

/**
 * Class DbConnector
 * @package App\Core
 */
class DbConnector
{
    private $host;
    private $dbName;
    private $user;
    private $password;
    private static $instance = null;
    private $connection;

    /**
     * DbConnector constructor.
     */
    public function __construct()
    {
        try {
            $config = new Config();
            $db = $config->getConfig('db');
            $this->host = $db['host'];
            $this->dbName = $db['dbName'];
            $this->user = $db['user'];
            $this->password = $db['password'];

            $con = new \PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->user, $this->password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $con->exec("SET CHARACTER SET utf8");

            $this->connection = $con;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }

    /**
     * @throws \Exception
     */
    private function __clone()
    {
        throw new \Exception("Can't clone a singleton");
    }

    /**
     * @return PDO
     */
    public static function getConnection()
    {
        if (self::$instance == null) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance->connection;
    }
}
