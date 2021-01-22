<?php


namespace repository;


use User\User;

interface INoteRepository
{
    function findByUser(User $user): ?array;
}