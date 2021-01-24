<?php


namespace dao\sql;


use dao\AbstractDaoFactory;
use dao\INoteDao;
use dao\IUserDao;

class SqlDaoFactory extends AbstractDaoFactory
{
    public function createNoteDao(): INoteDao
    {
        return new SqlNoteDao();
    }

    public function createUserDao(): IUserDao
    {
        return new SqlUserDao();
    }
}