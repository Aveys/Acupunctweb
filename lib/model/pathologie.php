<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 12/03/15
 * Time: 14:44
 */
include_once('config.php');
require_once('db.php');

function getPathologie(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query = 'SELECT patho.desc FROM patho;';
    $stmt = $db->pdo->query($query);
    $arrAll = $stmt->fetchAll();
    return $arrAll;
}
function getSymptomes(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query = 'select DISTINCT symptome.`desc` from symptome;';
    $stmt = $db->pdo->query($query);
    $arrAll = $stmt->fetchAll();
    return $arrAll;
}
function getSymptByPath(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query = 'select p.`desc` as "Pathologie",s.`desc` as "Symptomes" from symptome s, symptPatho sp, patho p where s.idS=sp.idS and sp.idP=p.idP order by Symptomes;';
    $stmt = $db->pdo->query($query);
    $arrAll = $stmt->fetchAll();
    return $arrAll;
}