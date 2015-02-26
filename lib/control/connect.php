<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 14:37
 */
session_start();

global $template;
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
header('Location: /index.php');

?>