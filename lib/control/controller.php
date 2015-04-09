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
require_once 'lib/model/articles.php';

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

function getSearchResults()
{
    $listpatho = array();
    $listfin=array();
    $filter_string = 'REGEXP \'(';

   if(isset($_POST['filters']))
   {
       $array = $_POST['filters'];
       for($i = 0, $size = count($array); $i < $size; $i++)
       {
           $filter_string = $filter_string . $array[$i];
           if($i +1 < $size)
           {
               $filter_string = $filter_string . '|';
           }
       }
       $filter_string = $filter_string . ')\'';
       echo $filter_string;

       $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
       $temp = $db->pdo->query('Select pat.idP from patho pat, symptome sym, keySympt ks, keywords ke, symptPatho sp where ks.idK = ke.idK AND ks.idS = sym.idS AND sp.idS = sym.ids AND sp.idp = pat.idP AND ke.name ' . $filter_string . ";");
       $result = $temp->fetchAll();
       foreach ($result as $value) {
           $listpatho[]= new Pathologie($value["idP"]);
       }
       foreach($listpatho as $val) {
           $listfin[] = array("NOM" => $val->getNom(), "SYMPT" => $val->getSympt());
       }
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
function getListArticles(){
    return getArticles();
}


function adminArticles()
{
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == '1')
    {
        if (isset($_GET['delete']))
        {
            deleteArticle($_GET['delete']);
        }

        if (isset($_GET['add']) && isset($_POST['inputTitle']) && isset($_POST['inputArticle']))
        {
            addArticle($_POST['inputTitle'], $_POST['inputArticle'], $_SESSION['user']);
        }
    }
}


?>