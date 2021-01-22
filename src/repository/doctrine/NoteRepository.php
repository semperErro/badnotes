<?php


namespace Note;

use Doctrine\ORM\EntityRepository;
use repository\INoteRepository;
use User\User;

class NoteRepository extends EntityRepository implements INoteRepository
{
    public function findByUser(User $user): ?array
    {
        return $this->findBy(["user" => $user]);
    }
}