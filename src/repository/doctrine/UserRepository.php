<?php


namespace User;

use Doctrine\ORM\EntityRepository;
use repository\IUserRepository;

class UserRepository extends EntityRepository implements IUserRepository
{
    public function findById(int $id): ?User
    {
        return $this->find($id);
    }
}