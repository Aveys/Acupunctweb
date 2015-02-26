<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 14:37
 */
error_reporting(E_ALL | E_STRICT);

ini_set('display_errors', true);
require_once "../model/user.php";
session_start();

global $template;

if(isset($_POST['login']) && isset($_POST['pwd']))
{
    if(preg_match("#[a-zA-Z0-9]#",$_POST['login']) && preg_match("#[a-zA-Z0-9]#",$_POST['pwd']))
    {
        if(user_connect($_POST['login'],$_POST['pwd']) == true)
        {
            $_SESSION['loginConnection'] = 'connected';
            $_SESSION['user'] = $_POST['login'];
            $_SESSION['userName'] = getUser($_POST['login']);
        }else{
            $_SESSION['loginConnection'] = 'invalidLogin';
        }
    }else {
        $_SESSION['loginConnection'] = 'invalidInput';
    }
}else{
    $_SESSION['loginConnection'] = 'invalidInput';
}
header('Location: /index.php');

?>