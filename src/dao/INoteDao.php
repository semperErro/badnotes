<?php


namespace dao;


use model\Note;

interface INoteDao
{
    function findById(int $id): ?Note;

    function findByUserId(int $userId): ?array;

    function createNote(Note $note): bool;

    public function updateNote(Note $note): bool;

    public function deleteNote(int $id): bool;
}