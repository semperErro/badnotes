<?php


namespace repository;


use User\User;

interface IUserRepository
{
    function findById(int $id): ?User;
}