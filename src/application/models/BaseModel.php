<?php

namespace Kodemaster\Todo\application\models;

use Kodemaster\Todo\infra\database\DatabaseConnection;
use PDO;

abstract class BaseModel
{
    protected PDO $db;
    protected string $table;

    protected function __construct()
    {
        $database = new DatabaseConnection();
        $this->db = $database->getConnection();
    }

    protected function select()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}