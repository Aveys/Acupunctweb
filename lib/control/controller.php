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
function getListSymptByPatho(){
    $listpatho = array();
    $listfin=array();
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $temp = $db->pdo->query("Select p.idP from patho p");
    $result = $temp->fetchAll();
    foreach ($result as $value) {
        $listpatho[]= new Pathologie($value['idP']);
    }
    foreach($listpatho as $val){
        $listfin[]=array("NOM" => $val->getNom(),"SYMPT" => $val->getSympt());
    }
    return $listfin;
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

    $filterList = array();

    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $temp = $db->pdo->query("Select name from keywords");
    $result = $temp->fetchAll();

    if($temp->rowCount() > 0)
    {
        foreach ($result as $val)
        {
            $filterList[] = $val['name'];
        }
        $template->assign('filtersList', $filterList);
    }else{
        $template->assign('filtersList', 'null');
    }



}

?>