<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 09:21
 */

class database
{
    static $pdo;
    public function initDB($host, $name, $user, $pwd)
    {
        try {
            global $pdo;
            $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $name, $user, $pwd);
            $pdo->beginTransaction();
        } catch (Exception $e) {
            echo $e->getMessage() . "<br/>";
            echo $e->getCode();
        }

    }
}

?>