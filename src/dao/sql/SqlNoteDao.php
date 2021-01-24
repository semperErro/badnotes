<?php


namespace dao\sql;


use dao\INoteDao;
use model\User;

class SqlNoteDao extends AbstractSqlDao implements INoteDao
{

    function findByUser(User $user): ?array
    {
        // TODO: Implement findByUser() method.
    }
}