<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 14:37
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
session_start();

global $template;
echo "connect.php";
var_dump($_POST);
if(isset($_POST['login']) && isset($_POST['pwd']))
{

    if(user_connect($_POST['login'],$_POST['pwd']) == true)
    {
        $_SESSION['loginConnection'] = 'connected';
        $_SESSION['user'] = $_POST['login'];
    }
    $_SESSION['loginConnection'] = 'invalidLogin';
}else{
    $_SESSION['loginConnection'] = 'invalidInput';
}
//header('Location: /index.php');

?>