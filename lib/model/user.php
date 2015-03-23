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
//include_once('config.php');
require_once('db.php');

function createUser($login, $password, $name, $mail)
{

}

function getUser($login)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("SELECT firstname FROM users WHERE login=?");
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

function user_create($username, $firstname, $lastname, $email, $passwd1, $passwd2)
{
    $result = false;
    if($passwd1 === $passwd2)
    {
        $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
        $sql_prepared = $db->pdo->prepare("SELECT login FROM users WHERE email=? OR login=?");
        $sql_prepared->execute(array($email, $username));
        //$sql_result =  $sql_prepared->fetchColumn();
        if($sql_prepared->rowCount()==0)
        {
            $sql_prepared2 = $db->pdo->prepare("INSERT INTO users (login, password,firstname,lastname,email,admin) VALUES (?,?,?,?,?,0)");

            $sql_prepared2->bindParam(1, $username);
            $sql_prepared2->bindParam(2, $passwd1);
            $sql_prepared2->bindParam(3, $firstname);
            $sql_prepared2->bindParam(4, $lastname);
            $sql_prepared2->bindParam(5, $email);

            if($sql_prepared2->execute())
            {
                $result = true;
            }else{
                $result = false;
            }

        }else{
            $result = false;
        }

    }else{
        $result = false;
    }
    return $result;
}


?>