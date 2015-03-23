<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 12/03/15
 * Time: 14:44
 */
include_once('config.php');
require_once('db.php');

function getMeridien(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query = 'select m.nom as "Nom" from meridien m;';
    $stmt = $db->pdo->query($query);
    $arrAll = $stmt->fetchAll();
    return $arrAll;
}
