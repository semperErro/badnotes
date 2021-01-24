<?php


namespace dao\sql;


use PDO;

abstract class AbstractSqlDao
{
    protected string $tableName;

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
        $stmt = pdo()->prepare($sql);
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
        $stmt = pdo()->prepare($sql);
        $stmt->bindValue(":value", $value);
        if (!$stmt->execute() == false) {
            return null;
        }

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($res == []) {
            return null;
        }

        return $res;
    }
}