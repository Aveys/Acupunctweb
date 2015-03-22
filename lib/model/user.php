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
include_once('config.php');
require_once('db.php');

function createUser($login, $password, $name, $mail)
{

}

function getUser($login)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("SELECT name FROM users WHERE login=?");
    $sql_prepared->execute(array($login));
    $sql_result =  $sql_prepared->fetchColumn();
    if($sql_result)
    {
        return $sql_result;
    }else{
        return null;
    }

}

function user_connect($login, $password)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("SELECT login FROM users WHERE login=? AND password=?");
    $sql_prepared->execute(array($login,$password));
    $sql_result =  $sql_prepared->fetchColumn();
    if($sql_result == $login)
    {
        $result = true;
    }else{
        $result = false;
    }
    return $result;


}



?>