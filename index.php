<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 26/02/15
 * Time: 08:41
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);
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
            $template->assign("activepage","index");
            $template->draw('index');
            break;
        case "patho":
            $template->assign("activepage","patho");
            $result=getListSymptByPath();
            $template->assign("listePatho",$result);
            $html = $template->draw('patho',$return_string = true );
            echo $html;
            break;
        case "search":
            getSearchFilters();
            $template->assign("activepage","search");
            $listMeridien=getListMeridien();
            $template->assign("listMeridien",$listMeridien);
            $html=$template->draw('search',$return_string = true);
            echo $html;
            break;
        case "about":
            $template->assign("activepage","about");
            $template->draw('about');
            break;
        case "signup":
            $template->assign("activepage","signup");
            $template->draw('signup_user');
            break;
        default:
            $template->assign("activepage","index");
            $template->draw('index');
            break;
    }
}else{
    $template->assign("activepage","index");
    $template->draw('index');
}


?>