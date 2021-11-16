<?php
/*
 *  abc Framework v2
 *  Ekrana Html elementleri eklemek ve elementleri manipüle etmek için kullanılır. Controller Class'ı tarafından kullanılır.
 *
 *  Created by Okan Bahadır Soygür
 *
*/


class Html{


    public function __construct($pageTitle = "View",$description = "abc Framework", $keywords = "abc Framework" )
    {

        $this->addHeader($pageTitle, $description,$keywords);

    }



    //bu fonksiyon siteye settings.json'daki site ismini ve sayfa ismini header tag'ları ile ekler. Burası Controller'daki herhangibir fonksiyona View tanımlandığında çalışır.
    public function addHeader($pageTitle = "View",$description = "abc Framework", $keywords = "abc Framework"){

        echo "
        <!DOCTYPE html>
        <html lang='tr'>
        <head>
        <title>".$pageTitle." | ".SITE_NAME."</title>
        <meta charset='UTF-8'>
        <meta name='description' content='".$description."'>
        <meta name='keywords' content='".$keywords."'>
        <meta name='author' content='abc Framework | Okan Bahadır Soygür'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        </head>
        </html>
        ";

    }






}


?>