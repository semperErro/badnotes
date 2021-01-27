<?php


namespace dao\doctrine;

use dao\INoteDao;
use Doctrine\ORM\EntityRepository;
use model\Note;

class NoteRepository extends EntityRepository implements INoteDao
{
    public function findByUserId(int $userId): ?array
    {
        return $this->findBy(["user" => $userId]);
    }

    function findById(int $id): ?Note
    {
        // TODO: Implement findById() method.
    }

    function createNote(Note $note): bool
    {
        // TODO: Implement createNote() method.
    }

    public function updateNote(Note $note): bool
    {
        // TODO: Implement updateNote() method.
    }

    public function deleteNote(int $id): bool
    {
        // TODO: Implement deleteNote() method.
    }
}