<?php

/*
 *  abc Framework v2
 *  Gelen veya giden request'lerin sql,html ve özel karekterlerden temizlenmesine yarayan static bir class'dır.
 *  Bu Class her hangi bir Controller altında tanımlama yapmadan static olarak çağırılabilir.
 *
 *  Created by Okan Bahadır Soygür
 *
*/


class Security{

    public static function htmlJavascriptClear($string){

        $sec1 =  strip_tags($string);
        $sec2 = htmlentities($sec1);

        return $sec2;

    }


    public static function sqlInjectionClear($string){

        $sec1 = strip_tags($string);
        $sec2 = htmlentities($sec1);
        $sec3 = addslashes($sec2);
        $sec4 = preg_replace('/[^a-zA-Z0-9]+/', '', $sec3);

        return $sec4;

    }


}

?>