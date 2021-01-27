<?php


namespace controller;

use dao\INoteDao;
use model\Note;

/**
 * Class NoteController
 * @package controller
 *
 * Responsibilities: Create, Replace, Update and Delete Users
 */
class NoteController
{
    protected INoteDao $dao;

    /**
     * NoteController constructor.
     * @param INoteDao $dao
     */
    public function __construct(INoteDao $dao)
    {
        $this->dao = $dao;
    }

    public function createNote(string $title, string $text, int $date, int $userId): ?Note
    {
        $note = new Note($title, $text, $date, $userId);
        return $this->dao->createNote($note) ? $note : null;
    }

    public function updateNote(int $id, string $title, string $text, int $date, int $userId): ?Note
    {
        $newNote = new Note($title, $text, $date, $userId, $id);
        /** @var Note $oldNote */
        $oldNote = $this->dao->findById($id);
        if ($oldNote == null || $oldNote->getUserId() != $userId) {
            return null;
        }

        return $this->dao->updateNote($newNote) ? $newNote : null;
    }

    public function deleteNote(int $id): bool
    {
        return $this->dao->deleteNote($id);
    }

    public function getNotesByUserId(int $userId): ?array
    {
        return $this->dao->findByUserId($userId);
    }
}