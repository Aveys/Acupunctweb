<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 12/03/15
 * Time: 14:44
 */
include_once('config.php');
require_once('db.php');
class Pathologie
{
    var $symptomes;
    function Pathologie($id){
        $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
        $query=$db->pdo->prepare("select s.desc from symptPatho sp, symptome s where sp.idP=:id and sp.idS=s.idS;");
        if ($query->execute($id)) {
            while ($row = $query->fetch()) {
                print_r($row);
            }
        }
        
    }
}