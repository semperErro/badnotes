<?php


namespace repository;


use User\User;

interface IUserRepository
{
    function findById(int $id): ?User;

    function findByEmail(string $email): ?User;

    function findByName(string $name): ?User;
}