<?php

namespace SourcePot;

use Config;
use \PDO, \PDOStatement;


class Database extends PDO {
    protected static ?self $instance = null;

    public static function getInstance(): self {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct() {
        // initialise PDO parameters and connect
        $host = Config::DB_HOST ?? 'localhost';
        $port = Config::DB_PORT ?? 3306;
        $db_name = Config::DB_DATABASE ?? false;

        $dsn = "mysql:host=$host;port=$port;charset=utf8mb4" . ($db_name ? ";dbname=$db_name" : '');

        parent::__construct($dsn, Config::DB_USER, Config::DB_PASS);

        // set default fetch mode to object
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    /**
     * Wrapper for prepare/execute
     * @param string $query The SQL query to execute
     * @param array $data A key/value pair of items
     * @return PDOStatement The resulting Statement object from PDO
     */
    public function run(string $query, array $data = []): PDOStatement
    {
        $stmt = $this->prepare($query);
        $stmt->execute($data);
        return $stmt;
    }
}
