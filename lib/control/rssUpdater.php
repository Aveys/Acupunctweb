<?php
/**
 * Created by PhpStorm.
 * User: arthurveys
 * Date: 08/04/15
 * Time: 22:06
 */
require_once "lib/model/db.php";
require_once "lib/model/articles.php";

function updateRSS(){
    // édition du début du fichier XML
    $date1=("D, d M Y H:i:s");
    $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss version=\"2.0\">\n";
    $xml .= "<channel>\n";
    $xml .= "<title>Acupunctweb</title>\n";
    $xml .= "<lastBuildDate>".$date1."</lastBuildDate>";
    $xml .= "<link>http://www.acupunctweb.fr</link>\n";
    $xml .= "<description>La référence de l'acupuncture</description>\n";

    $listArticles=getArticles();
    foreach ($listArticles as $value) {
        $date2 = date("D, d M Y H:i:s", strtotime($value["datePub"]));
        $xml .= "<item>\n";
        $xml .= "<title>".utf8_encode($value["title"])."</title>\n";
        $xml .= "<link>http://www.acupunctweb.fr</link>\n";
        $xml .= "<pubDate>".$date2." GMT</pubDate>\n";
        $xml .= "<description>".utf8_encode($value["Content"])."</description>\n";
        $xml .= "</item>\n";
    }
    // édition de la fin du fichier XML
    $xml .= "</channel>\n";
    $xml .= "</rss>\n";

// écriture dans le fichier
    $fp = fopen("rss.xml", "w+");
    fputs($fp, $xml);
    fclose($fp);

}