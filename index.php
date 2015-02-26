<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 08:41
 */

include 'inc/rain.tpl.class.php';
require_once 'lib/control/controller.php';
require_once 'config.php';

initDB(config::$DB_host, config::$DB_DBname, config::$DB_user, config::$DB_pwd);

$template = new RainTPL;
raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "lib/view/");

$template->draw('index');


?>