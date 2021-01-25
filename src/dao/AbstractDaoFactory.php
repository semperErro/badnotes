<?php


namespace dao;


abstract class AbstractDaoFactory
{
    public abstract function createNoteDao(string $tableName): INoteDao;

    public abstract function createUserDao(string $tableName): IUserDao;
}