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

    foreach($_SESSION as $key => $value)
    {
        $template->assign($key,$value);
    }
    database::initDB(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
}

function user_connect()
{

}

function user_disconnect()
{
    global $template;
    $template->assign('user', 'NULL');
    $template->assign('loginConnection', 'disconnected');
}



?>