<?php
function getArticles(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $tmp = $db->pdo->query("SELECT title,Content,datePub,author FROM articles");
    $result= $tmp->fetchAll();
    return $result;
}