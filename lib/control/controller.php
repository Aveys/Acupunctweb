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
require_once 'lib/model/meridien.php';

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
    $prettyTable=array();
    foreach ($listMer as $value) {
        $prettyTable[]=$value["NOM"];
    }
    return $prettyTable;
}
function getListType(){
    $listMer = getTypes();
    $prettyTable=array();
    foreach ($listMer as $value) {
        $prettyTable[]=$value["TYPE"];
    }
    return $prettyTable;
}
function getListSymptByPathoFiltred($mer,$type){
    $listpatho = array();
    $listfin=array();
    if($mer == "Tous" && $type=="Toutes"){
        return getListSymptByPatho();
    }
    if($mer == "Tous"){
        $mer = "%";
    }
    if($type == "Toutes"){
        $type="%";
    }
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    if(isset($mer))
    $temp = $db->pdo->query('Select p.idP from patho p join meridien m on p.mer=m.code where m.nom like "%'.$mer.'" and p.type like "%'.$type.'";');
    $result = $temp->fetchAll();
    foreach ($result as $value) {
        $listpatho[]= new Pathologie($value["idP"]);
    }
    foreach($listpatho as $val){
        $listfin[]=array("NOM" => $val->getNom(),"SYMPT" => $val->getSympt());
    }
    return $listfin;
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