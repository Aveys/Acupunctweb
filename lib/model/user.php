<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 09:21
 */

/*
 * @param string $login Login of new created user
 * @param string $password Password of new created user
 * @param string $name Name of new created user
 * @param string $mail E-Mail address of new created user
 * @return boolean Creation acknowledge
 */
require_once('lib/model/db.php');

function createUser($login, $password, $name, $mail)
{

}

function getUser($login)
{

}

function connectUser($login, $password)
{
    $sql_prepared = database::$pdo->prepare("SELECT login FROM users WHERE login=? AND password=?");
    $sql_prepared->execute(array($login,$password));
    $result =  $sql_prepared->fetchAll();
}


?>