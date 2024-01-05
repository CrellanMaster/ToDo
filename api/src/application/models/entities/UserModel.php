<?php

namespace Kodemaster\Todo\application\models\entities;

use Kodemaster\Todo\application\models\BaseModel;
use PDO;
use PDOException;

class UserModel extends BaseModel
{

    protected string $table = "users";

    public function select()
    {
        parent::select();
    }

    public function selectById($id)
    {
        parent::selectById($id);
    }

    public function selectByEmail($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam("email", $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function create($name, $email, $password)
    {
        try {
            $query = "INSERT INTO {$this->table} (name, email , password) VALUES (:name, :email,:password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam("name", $name);
            $stmt->bindParam("email", $email);
            $stmt->bindParam("password", $password);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}