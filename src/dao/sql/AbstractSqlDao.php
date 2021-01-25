<?php


namespace dao\sql;


use PDO;

abstract class AbstractSqlDao
{
    protected string $tableName;

    protected function pdo(): PDO
    {
        $host = "db";
        $username = "root";
        $password = "foobarbaz"; // Das hier scheint zu gehen...
        $dbname = "badnotes";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $pdo;
        } catch (\PDOException $exception) {
            echo 'Verbindung fehlgeschlagen! ' . $exception->getMessage();
            die(1);
        }
    }

    /**
     * AbstractSqlDao constructor.
     * @param string $tableName
     */
    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }


    public function findAllByAttribute(string $attribute, $value): ?array
    {
        $sql = "SELECT * FROM `$this->tableName` WHERE $attribute = :value";
        $stmt = $this->pdo()->prepare($sql);
        $stmt->bindValue(":value", $value);
        if ($stmt->execute() == false) {
            return null;
        }

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($res == []) {
            return null;
        }

        return $res;
    }

    public function findOneByAttribute(string $attribute, $value): ?array
    {
        $sql = "SELECT * FROM `$this->tableName` WHERE $attribute = :value LIMIT 1";
        $pdo = $this->pdo();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":value", $value);
        if ($stmt->execute() == false) {
            return null;
        }

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res == []) {
            return null;
        }

        return $res;
    }
}