<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 09:18
 */

require_once 'lib/model/db.php';
require_once 'lib/model/user.php';

function initAll()
{
    global $template;
    database::initDB(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);

    if(isset($_SESSION['user']))
    {
        $template->assign('user', $_SESSION['user']);
        $template->assign('loginConnection', 'connected');
    }else{
        $template->assign('user','NULL');
        $template->assign('loginConnection', 'disconnected');
    }
}

function user_connect()
{
    global $template;
    if(isset($_POST['login']) && isset($_POST['pwd'])
        && user_connect($_POST['login'],$_POST['pwd']) == true)
    {
        $template->assign('loginConnection', 'connected');
    }else{
        // Cannot connect.
        $template->assign('loginConnection', 'invalid');
    }
}

function user_disconnect()
{
    global $template;
    $template->assign('user', 'NULL');
    $template->assign('loginConnection', 'disconnected');
}



?>