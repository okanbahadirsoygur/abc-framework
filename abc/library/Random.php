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



    //tanımlı olan büyük-küçük harfler ve sayılardan oluşan random değer döndürür.
    function randomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }//for
        return $randomString;
    }//func


    //tanımlı sayılardan oluşan random değer döndürür.
    function randomNumber($length) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }//for
        return $randomString;
    }//func


    //küçük harf ve sayılardan oluşan random byte değeri döndürür.
    function randomByte($lenght){
        $bytes = random_bytes($lenght);
        return bin2hex($bytes);
    }


}

?>