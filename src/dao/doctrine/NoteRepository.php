<?php


namespace dao\doctrine;

use dao\INoteDao;
use Doctrine\ORM\EntityRepository;
use model\User;

class NoteRepository extends EntityRepository implements INoteDao
{
    public function findByUser(User $user): ?array
    {
        return $this->findBy(["user" => $user]);
    }
}