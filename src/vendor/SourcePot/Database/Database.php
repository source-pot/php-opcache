<?php

namespace SourcePot\Database;

use SourcePot\Singleton\SingletonTrait;
use \PDO, \PDOStatement;


class Database extends PDO {
    use SingletonTrait;

    public function __construct() {
        // initialise PDO parameters and connect
        $host = getenv('DB_HOST') ?? 'localhost';
        $port = getenv('DB_PORT') ?? 3306;
        $db_name = getenv('DB_DATABASE') ?? false;

        $dsn = "mysql:host=$host;port=$port;charset=utf8mb4" . ($db_name ? ";dbname=$db_name" : '');

        parent::__construct($dsn, getenv('DB_USER'), getenv('DB_PASS'));

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
