<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 09:21
 */


/**
 * Class Database
 */
class Database
{
    /**
     * @var PDO
     */
    public $pdo;

    /**
     * Constructor
     * @param $host Hostname
     * @param $name Database name
     * @param $user Username
     * @param $pwd  Password
     */
    public function __construct($host, $name, $user, $pwd)
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $name.';charset=utf8', $user, $pwd);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->pdo->beginTransaction();
        } catch (Exception $e) {
            echo $e->getMessage() . "<br/>";
            echo $e->getCode();
        }
    }
}

?>