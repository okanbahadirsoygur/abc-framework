<?php

/*
 * 20-09-2021
 * abc Framework v1 Random
 *
 * Random veriler üretmeye yarayan kütüphane
 *
 * Created by Okan Bahadır Soygür
 *
 */


class Random{



    function randomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }//for
        return $randomString;
    }//func


}

?>