<?php

namespace Kodemaster\Todo\infra\database;

use PDO;

class DatabaseConnection
{
    private PDO $database;

    public function __construct()
    {
        try {
            $this->database = new \PDO("mysql:host=" . $_ENV["DB_HOST"] . ";port=3360;dbname=" . $_ENV["DB_NAME"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
            $this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getConnection(): PDO
    {
        return $this->database;
    }

    public function __destruct()
    {
        $this->database = null;
    }
}