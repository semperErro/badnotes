<?php


namespace dao;


use model\User;

interface INoteDao
{
    function findByUser(User $user): ?array;
}