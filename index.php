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
            $listArticles= getListArticles();
            $template->assign("listArticles",$listArticles);
            $template->assign("activepage","index");
            $html=$template->draw('index',$return_string = true);
            echo $html;
            break;
        case "patho":
            $template->assign("activepage","patho");
            $template->assign("oldMer","Tous");
            $template->assign("oldType","Toutes");
            if(isset($_GET["Meridien"]) && isset($_GET["Type"])){
                $result=getListSymptByPathoFiltred(htmlspecialchars($_GET["Meridien"]),htmlspecialchars($_GET["Type"]));
                $template->assign("oldMer",$_GET["Meridien"]);
                $template->assign("oldType",$_GET["Type"]);
                unset($_GET["Meridien"]);
                unset($_GET["Type"]);
            }
            else{
                $result=getListSymptByPatho();
            }
            $listMer = getListMeridien();
            $listType = getListType();
            $template->assign("listePatho",$result);
            $template->assign("listeMeridien",$listMer);
            $template->assign("listeType",$listType);
            $html = $template->draw('patho',$return_string = true );
            echo $html;
            break;
        case "search":
            getSearchFilters();
            $result = getSearchResults();
            $template->assign("listePatho",$result);
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
            $listArticles= getListArticles();
            $template->assign("listArticles",$listArticles);
            $template->assign("activepage","index");
            $html=$template->draw('index',$return_string = true);
            echo $html;
            break;
    }
}
else{
    $listArticles= getListArticles();
    $template->assign("listArticles",$listArticles);
    $template->assign("activepage","index");
    $html=$template->draw('index',$return_string = true);
    echo $html;
}


?>