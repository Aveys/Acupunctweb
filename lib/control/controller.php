<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 09:18
 */

require_once 'lib/model/db.php';
require_once 'lib/model/user.php';
require_once 'lib/model/pathologie.php';

function initAll()
{
    global $template;
    global $db;

    foreach($_SESSION as $key => $value)
    {
        $template->assign($key, $value);
    }
    if(!isset($_SESSION['loginConnection']))
    {
        $template->assign('loginConnection', 'disconnected');
    }
    unset($_SESSION['loginConnection']);
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    //$db->initDB(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
}

/*function user_connect($login, $pwd)
{

}*/

function user_disconnect()
{
    global $template;
    $template->assign('user', 'NULL');
    $template->assign('loginConnection', 'disconnected');
}
function getListPathologie(){
    $listpatho = getPathologie();
    var_dump($listpatho);
}


?>