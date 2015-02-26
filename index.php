<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 08:41
 */

include 'inc/rain.tpl.class.php';

$template = new RainTPL;
raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "lib/view/");

$template->draw('index');


?>