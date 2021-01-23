<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace User;

use Doctrine\ORM\EntityRepository;
use repository\IUserRepository;

class UserRepository extends EntityRepository implements IUserRepository
{
    public function findById(int $id): ?User
    {
        return $this->find($id);
    }

    function findByEmail(string $email): ?User
    {
        return $this->findOneBy(["email" => $email]);
    }

    function findByName(string $name): ?User
    {
        return $this->findOneBy(["name" => $name]);
    }
}