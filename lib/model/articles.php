<?php

/**
 * Returns all articles
 * @return array (Articles)
 */
function getArticles(){
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $tmp = $db->pdo->query("SELECT id, title,Content,datePub,author FROM articles");
    $result= $tmp->fetchAll();
    return $result;
}

/**
 * Deletes specified article
 * @param $idArticle
 */
function deleteArticle($idArticle)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("DELETE FROM articles where id=?");
    $sql_prepared->execute(array($idArticle));
}

/**
 * Creates a new article
 * @param $title
 * @param $text
 * @param $author
 */
function addArticle($title, $text, $author)
{
    $db = new Database(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);
    $sql_prepared = $db->pdo->prepare("INSERT INTO articles(id, author, title, Content,datePub) VALUES(NULL,?,?,?,NOW())");
    $sql_prepared->execute(array($author, $title, $text));
}