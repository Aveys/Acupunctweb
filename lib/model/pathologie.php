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
    var $nom;
    var $id;
    function Pathologie($id){
        $this->symptomes=array();
        $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
        $query=$db->pdo->prepare("select p.idP as 'IDPATHO', p.desc as 'PATHO', s.desc as 'SYMPT'
                                    from symptPatho sp
                                      join patho p on sp.idP=p.idP
                                      JOIN symptome s on sp.idS=s.idS
                                    where sp.idP=?;");
        if ($query->execute(Array($id))) {
            foreach($query->fetchAll() as $value){
                $this->symptomes[]=$value["SYMPT"];
                $this->id=$value["IDPATHO"];
                $this->nom=$value["PATHO"];
            }

        }
        
    }
    function getSympt(){
        return $this->symptomes;
    }
    function getNom(){
        return $this->nom;
    }
}
function getTypes(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $query=$db->pdo->prepare('select distinct p.type as "TYPE" from patho p');
    if ($query->execute()) {
        return $query->fetchAll();

    }
}