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

/**
 * Class User
 */
class User {
    private $userID;
    private $isAdmin;
    private $login;
    private $lastname;
    private $firstname;

    /**
     * Constructor
     * @param $login Login (username)
     * @param $id userID
     * @param $admin user is admin or not
     * @param $firstname User firstname
     * @param $lastname User lastname
     */
    public function __construct($login,$id, $admin, $firstname, $lastname)
    {
        $this->userID = $id;
        $this->isAdmin = $admin;
        $this->login = $login;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    /**
     * @return User ID
     */
    public function getID()
    {
        return $this->userID;
    }

    /**
     * @return user authorization (admin or not)
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @return login (username)
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return Firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return Lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

}

/**
 * @param $login (username)
 * @return null|User (object from User class)
 */
function getUser($login)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("SELECT firstname, lastname, id, login, admin FROM users WHERE login=?");
    $sql_prepared->execute(array($login));
    $sql_result =  $sql_prepared->fetchAll();
    if($sql_result)
    {
        //var_dump($sql_result);
        $user = new User($sql_result[0]['login'], $sql_result[0]['id'], $sql_result[0]['admin'], $sql_result[0]['firstname'], $sql_result[0]['lastname']);
        return $user;
    }else{
        return null;
    }

}

/**
 * User connection from login and password
 * @param $login
 * @param $password
 * @return bool (connection result)
 */
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

/**
 * User creation from user data
 * @param $username
 * @param $firstname
 * @param $lastname
 * @param $email
 * @param $passwd1
 * @param $passwd2
 * @return bool (user creation result)
 */
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