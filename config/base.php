<?php


function pdo(): PDO
{
    $host = "db";
    $username = "root";
    $password = "foobarbaz";
    $dbname = "badnotes";

    return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}