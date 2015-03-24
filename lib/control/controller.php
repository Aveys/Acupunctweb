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
require_once 'lib/model/search.php';

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
    }else{
        if($_SESSION['loginConnection'] != 'connected')
        {
            unset($_SESSION['loginConnection']);
        }
    }
    if(!isset($_SESSION['loginSignup']))
    {
        $template->assign('loginSignup', '');
    }

    unset($_SESSION['loginSignup']);
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
    $listpatho = array();
    $prettyTable=array();
    foreach ($listpatho as $value) {

        foreach ($value as $key=>$val) {
            if($key === "desc"){
                $prettyTable[]=$val;
            }
        }

    }
    return $prettyTable;
}
function getListSymptByPath(){
    $listpatho = getSymptByPath();
    //var_dump($listpatho);
    $prettyTable=array();
    foreach ($listpatho as $value) {
        $prettyTable[$value["Pathologie"]]=$value["Symptomes"];
    }
    //var_dump($prettyTable);
    //return $listpatho;
    return $prettyTable;
}
function getListMeridien(){
    $listMer = getMeridien();
    //var_dump($listpatho);
    $prettyTable=array();
    foreach ($listMer as $value) {
        $prettyTable[]=$value["Nom"];
    }
    //var_dump($prettyTable);
    //return $listpatho;
    return $prettyTable;
}

function getSearchFilters()
{
    global $template;
    if(isset($_POST['filters']))
    {
        $template->assign('filters', $_POST['filters']);
    }else{
        $template->assign('filters', 'null');
    }
}

?>