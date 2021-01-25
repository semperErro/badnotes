<?php


namespace dao\sql;


use dao\AbstractDaoFactory;
use dao\INoteDao;
use dao\IUserDao;

class SqlDaoFactory extends AbstractDaoFactory
{
    public function createNoteDao(string $tableName): INoteDao
    {
        return new SqlNoteDao($tableName);
    }

    public function createUserDao(string $tableName): IUserDao
    {
        return new SqlUserDao($tableName);
    }
}