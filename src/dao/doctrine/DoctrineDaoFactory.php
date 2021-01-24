<?php


namespace dao\doctrine;


use dao\INoteDao;
use dao\IUserDao;

class DoctrineDaoFactory extends \dao\AbstractDaoFactory
{

    public function createNoteDao(): INoteDao
    {
        return new NoteRepository();
    }

    public function createUserDao(): IUserDao
    {
        return new UserRepository();
    }
}