<?php


namespace dao\sql;


use dao\IUserDao;
use model\User;

class SqlUserDao extends AbstractSqlDao implements IUserDao
{

    public function findById(int $id): ?User
    {
        $res = $this->findOneByAttribute("id", $id);
        if ($res == [] || $res == null) {
            return null;
        }
        return new User($res['name'], $res['email'], $res['password'], $res['id']);
    }

    public function findByEmail(string $email): ?User
    {
        $res = $this->findOneByAttribute("email", $email);
        if ($res == [] || $res == null) {
            return null;
        }
        return new User($res['name'], $res['email'], $res['password'], $res['id']);
    }

    public function createUser(User $user): bool
    {
        $sql = "INSERT INTO `$this->tableName` (`name`, `email`, `password`) VALUES (:name, :email, :password)";
        $stmt = pdo()->prepare($sql);
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        return $stmt->execute();
    }

    public function replaceUser(int $id, User $newUser): bool
    {
        $sql = "UPDATE `$this->tableName` SET name = :name, email = :email, password = :password WHERE id = :id";
        $stmt = pdo()->prepare($sql);
        $stmt->bindValue(":name", $newUser->getName());
        $stmt->bindValue(":email", $newUser->getEmail());
        $stmt->bindValue(":password", $newUser->getPassword());
        $stmt->bindValue(":id", $newUser->getId());
        return $stmt->execute();
    }

    public function updateUser(int $id, User $user): User
    {
        // TODO: implement
    }

    public function deleteUser(int $id): bool
    {
        $sql = "DELETE FROM `$this->tableName` WHERE id = :id";
        $stmt = pdo()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}