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
//require_once('lib/model/db.php');

function createUser($login, $password, $name, $mail)
{

}

function getUser($login)
{

}

function user_connect($login, $password)
{
    $result = false;
    echo "user_connect";
    if(preg_match("#[a-zA-Z0-9]#",$login) && preg_match("#[a-zA-Z0-9]#",$password))
    {
        echo "MATCH";
        //$sql_prepared = database::$pdo->prepare("SELECT login FROM users WHERE login=? AND password=?");
        //$sql_prepared->execute(array($login,$password));
        //$sql_result =  $sql_prepared->fetchAll();
        //var_dump($sql_result);
    }else{
        $result = false;
    }
    return $result;

}


?>