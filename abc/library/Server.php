<?php

/*
 * 03-10-2021
 * abc Framework v1 server
 *
 * Server hakkındaki bilgilere buradan ulaşılır.
 *
 * Created by Okan Bahadır Soygür
 *
 */


class Server{

    //burası sadece linux'de çalışmaktadır. MacOs'da çalışmamaktadır. Çünkü linux terminal kodlarını exec ediyoruz.
    //hdd/ssd bilgisi çekerken sorun yaşıyorum. Daha sonra düzeltilecek. Şuan için aşağıdaki değerler sorunsuz dönmektedir.
    //geriye json bilgisi döndürür. döndürülen değerler;
    //Ram değerleri Gigabyte(gb) cinsinden döndürülür;
    //{"cpu": 0, "cpu_model": "model name : Intel(R) Core(TM) i7-6700 CPU @ 3.40GHz", "mem_percent": 2.23, "mem_total":62.54, "mem_used":4.235, "mem_free":58.305}
    public function serverInfo(){


        if (PHP_OS_FAMILY === "Linux") {

            //cpu stat
            $prevVal = shell_exec("cat /proc/stat");
            $prevArr = explode(' ', trim($prevVal));
            $prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
            $prevIdle = $prevArr[5];
            usleep(0.15 * 1000000);
            $val = shell_exec("cat /proc/stat");
            $arr = explode(' ', trim($val));
            $total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
            $idle = $arr[5];
            $intervalTotal = intval($total - $prevTotal);
            $stat['cpu'] = intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
            $cpu_result = shell_exec("cat /proc/cpuinfo | grep model\ name");
            $stat['cpu_model'] = strstr($cpu_result, "\n", true);
            $stat['cpu_model'] = str_replace("model name    : ", "", $stat['cpu_model']);
            //memory stat
            $stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
            $mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
            $stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
            $mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
            $stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
            $stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];


            //output data by json

            $dizi = array();

            $dizi[0] = $stat['cpu'];
            $dizi[1] = $stat['cpu_model'];
            $dizi[2] = $stat['mem_percent'];
            $dizi[3] = $stat['mem_total'];
            $dizi[4] = $stat['mem_used'];
            $dizi[5] = $stat['mem_free'];

            return json_encode($dizi);

        }else{
            //server linux üzerinde değilse test amaçtı farazi veriler yollayalım. Çalıştığını test etmek için
            $dizi = array();

            //$dizi[0] = $stat['cpu'];
            $dizi[0] = "1";
            // $dizi[1] = $stat['cpu_model'];
            $dizi[1] = "model name : Intel(R) Core(TM) i7-6700 CPU @ 3.40GHz";
            //  $dizi[2] = $stat['mem_percent'];
            $dizi[2] = rand(1,5);
            //   $dizi[3] = $stat['mem_total'];
            $dizi[3] = "8";
            // $dizi[4] = $stat['mem_used'];
            $dizi[4] = "4.253999999999998";
            // $dizi[5] = $stat['mem_free'];
            $dizi[5] = "4";

            return json_encode($dizi);
        }

    }//func serverInfo

    //serverin ne kadar zamandır açık olduğunu döndürür.
    //örnek çıktı;
    //up 12 hours, 51 minutes
    public function uptime(){
        if (PHP_OS_FAMILY === "Linux") {
            echo shell_exec('uptime -p');
        }else{
            //server linux üzerinde değilse test amaçtı farazi veriler yollayalım. Çalıştığını test etmek için
            echo "up 1 hours, 21 minutes";
        }
    }


}//class



?>