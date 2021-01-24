<?php


namespace dao;


use model\User;

interface IUserDao
{
    function findById(int $id): ?User;

    function findByEmail(string $email): ?User;
}