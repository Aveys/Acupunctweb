<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 14:37
 */
error_reporting(E_ALL | E_STRICT);

ini_set('display_errors', true);
include_once "../../config.php";
include_once "../model/user.php";
session_start();

global $template;

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        case 'connect':
            connect();
            header('Location: /index.php');
            break;

        case 'signup':
            signup();
            header('Location: /index.php?page=signup');
            break;

        case 'disconnect':
            header('Location: /index.php');
            disconnect();
            break;
        case search :
            search();
        default:
            header('Location: /index.php');
            break;
    }
}else{
    header('Location: /index.php');
}

function connect()
{
    if(isset($_POST['login']) && isset($_POST['pwd']))
    {
        if(preg_match("#[a-zA-Z0-9]#",$_POST['login']) && preg_match("#[a-zA-Z0-9]#",$_POST['pwd']))
        {
            if(user_connect($_POST['login'],$_POST['pwd']) == true)
            {
                $_SESSION['loginConnection'] = 'connected';
                $_SESSION['user'] = $_POST['login'];
                $_SESSION['userName'] = getUser($_POST['login'])->getFirstname();
                $_SESSION['admin'] = getUser($_POST['login'])->isAdmin();
            }else{
                $_SESSION['loginConnection'] = 'invalidLogin';
            }
        }else {
            $_SESSION['loginConnection'] = 'invalidInput';
        }
    }else{
        $_SESSION['loginConnection'] = 'invalidInput';
    }

}

function disconnect()
{
    session_unset();
}

function signup()
{
    if(isset($_POST['inputUsername']) && isset($_POST['inputFirstname']) && isset($_POST['inputLastname']) && isset($_POST['inputEmail']) && isset($_POST['inputPassword']) && isset($_POST['inputPassword2']))
    {
        if(preg_match("#[a-zA-Z0-9 ]#",$_POST['inputUsername']) && preg_match("#[a-zA-Z0-9 ]#",$_POST['inputFirstname']) && preg_match("#[a-zA-Z0-9 ]#",$_POST['inputLastname']) && preg_match("#[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+#",$_POST['inputEmail']) && preg_match("#[a-zA-Z0-9 ]#",$_POST['inputPassword']) && preg_match("#[a-zA-Z0-9 ]#",$_POST['inputPassword2']))
        {
            if(user_create($_POST['inputUsername'],$_POST['inputFirstname'],$_POST['inputLastname'],$_POST['inputEmail'],$_POST['inputPassword'],$_POST['inputPassword2']))
            {
                $_SESSION['loginSignup'] = 'signedUp';
            }else{
                $_SESSION['loginSignup'] = 'invalidEmail';
            }

        }else {
            $_SESSION['loginSignup'] = 'invalidInput';
        }
    }else{
        $_SESSION['loginSignup'] = 'invalidInput';
        return false;
    }
}

?>