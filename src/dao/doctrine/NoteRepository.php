<?php


namespace dao\doctrine;

use Doctrine\ORM\EntityRepository;
use model\User;

class NoteRepository extends EntityRepository// implements INoteRepository
{
    public function findByUser(User $user): ?array
    {
        return $this->findBy(["user" => $user]);
    }
}