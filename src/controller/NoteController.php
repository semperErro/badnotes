<?php


namespace controller;

use dao\INoteDao;
use model\Note;
use model\User;

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

    public function createNote(int $id, string $title, string $text, int $date, User $user): ?Note
    {
        $note = new Note($id, $title, $text, $date, $user);
        return $this->dao->createNote($note) ? $note : null;
    }

    public function updateNote(int $id, string $title, string $text, int $date, User $user): ?Note
    {
        $note = new Note($id, $title, $text, $date, $user);
        return $this->dao->updateNote($note) ? $note : null;
    }

    public function deleteNote(int $id): bool
    {
        return $this->dao->deleteNote($id);
    }
}