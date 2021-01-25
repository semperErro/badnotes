<?php


namespace dao\doctrine;


use dao\INoteDao;
use dao\IUserDao;

class DoctrineDaoFactory extends \dao\AbstractDaoFactory
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