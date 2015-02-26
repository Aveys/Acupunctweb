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
    initDB(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);

    if(isset($_SESSION['user']))
    {
        $template->assign('user', $_SESSION['user']);
    }else{
        $template->assign('user','NULL');
    }
}

function connect()
{
    if(isset($_POST['login']) && isset($_POST['pwd']))
    {

    }else{

    }
}




?>