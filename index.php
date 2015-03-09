<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 08:41
 */
//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors', true);
include 'inc/rain.tpl.class.php';
require_once 'lib/control/controller.php';
require_once 'config.php';

session_start();

global $template;
$template = new RainTPL;
raintpl::configure("base_url", null);
raintpl::configure("tpl_dir", "lib/view/");

initAll();

if(isset($_GET['page']))
{
    switch($_GET['page'])
    {
        case "home":
            $template->draw('index');
            break;
        case "patho":
            $template->draw('patho');
            break;
        case "search":
            $template->draw('search');
            break;
        case "about":
            $template->draw('about');
            break;
        case "signup":
            $template->draw('signup_user');
            break;
        default:
            $template->draw('index');
            break;
    }
}else{
    $template->draw('index');
}


?>