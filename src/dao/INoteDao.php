<?php


namespace dao;


use model\Note;
use model\User;

interface INoteDao
{
    function findByUser(User $user): ?array;

    function createNote(Note $note): bool;

    public function updateNote(Note $note): bool;

    public function deleteNote(int $id): bool;
}