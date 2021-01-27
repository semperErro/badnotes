<?php


namespace dao\doctrine;


use dao\AbstractDaoFactory;
use dao\INoteDao;
use dao\IUserDao;

class DoctrineDaoFactory extends AbstractDaoFactory
{

    public function createNoteDao(string $tableName): INoteDao
    {
        return new NoteRepository();
    }

    public function createUserDao(string $tableName): IUserDao
    {
        return new UserRepository();
    }
}