<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 12/03/15
 * Time: 14:44
 */
include('../../config.php');
require_once('db.php');

function getPathologie(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query = 'SELECT patho.desc FROM patho;';
    $stmt = $db->query($query);
    $arrAll = $stmt->fetchAll();
    return $arrAll;
}