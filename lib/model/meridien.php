<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 26/03/15
 * Time: 14:44
 */
include_once('config.php');
require_once('db.php');

/**
 * @return array (Meridiens)
 */
function getMeridien(){

    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query=$db->pdo->prepare('select distinct nom as "NOM" from meridien');
    if ($query->execute()) {
        return $query->fetchAll();

    }
}