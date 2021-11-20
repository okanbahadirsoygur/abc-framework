<?php

/*
 *  abc Framework v2
 *  settings.json'da tanımlanan bilgiler burada cons (sabit) olarak  tanımlanır.
 *  Daha sonra bu sabitler Framework tarafından kullanır.
 *
 *  Created by Okan Bahadır Soygür
 *
*/

$pure_json = file_get_contents("abc/settings.jsonx");

$settings = json_decode($pure_json, true);

define("SITE_NAME", $settings["SITE_NAME"]);
define("SITE_URL", $settings["SITE_URL"]);
define("HOME_URL", $settings["HOME_URL"]);
define("VERSION", $settings["VERSION"]);
define("ERROR_REPORTING", $settings["ERROR_REPORTING"]);
define("DATABASE_ENABLE", $settings["DATABASE_ENABLE"]);
define("DATABASE_PDO_TYPE", $settings["DATABASE_PDO_TYPE"]);
define("HOSTNAME", $settings["HOSTNAME"]);
define("DATABASE", $settings["DATABASE"]);
define("PORT", $settings["PORT"]);
define("USER", $settings["USER"]);
define("PASSWORD", $settings["PASSWORD"]);

//Sabitlere atamamızı yaptıktan sonra settings ve pre_json değişkenlerini ram'dan silelim. Böylece daha sonra başka yerde çakışma yaşanmasın.
unset($settings);
unset($pure_json);



?>