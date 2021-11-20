<?php

/*
 *  abc Framework v2
 *  Framework'e ait bütün kütaphaneler ve çekirdek(core) bileşenler burada yüklenmelidir.
 *
 *  Created by Okan Bahadır Soygür
 *
*/

require_once "abc/library/Publish.php";
require_once "abc/core/Constants.php";
require_once "abc/core/ErrorHandle.php";
require_once "abc/library/Security.php";
require_once "abc/core/Html.php";
require_once "abc/core/Database.php";
require_once "abc/core/Controller.php";
require_once "abc/core/Router.php";



require_once "abc/library/Browser.php";
require_once "abc/library/Server.php";
require_once "abc/library/Random.php";
require_once "abc/library/FileUpload.php";



$init = new Router();

?>
