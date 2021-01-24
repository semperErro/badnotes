<?php /** @noinspection PhpIncompatibleReturnTypeInspection */


namespace dao\doctrine;

use Doctrine\ORM\EntityRepository;
use model\User;

class UserRepository extends EntityRepository// implements IUserRepository
{
    public function findById(int $id): ?User
    {
        return $this->find($id);
    }

    function findByEmail(string $email): ?User
    {
        return $this->findOneBy(["email" => $email]);
    }
}