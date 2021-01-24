<?php


namespace dao;


abstract class AbstractDaoFactory
{
    public abstract function createNoteDao(): INoteDao;

    public abstract function createUserDao(): IUserDao;
}