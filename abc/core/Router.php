<?php

/*
 *  abc Framework v2 Router
 *
 *  Created by Okan Bahadır Soygür
 *
*/

class Router{

    //url'e gelen 1inci parametre o anki Controller'i tutar
    protected $CurrentController;

    //url'e gelen 2inci parametre o anki fonksiyon'u tutar
    protected $CurrentMethod;

    //url'e gelen 3üncü paremtre o anki data'yı tutar
    protected $CurrentData;


    public function __construct()
    {

       //gerekirse hata mesajlarını basmak için kullanacağız
       $publish = new Publish();

       $url = $this->GetUrl();

        //eğer sitenin kendisi çekiliyorsa (bkz:www.example.com)
        //ozaman ayarlardaki HOME_URL sayfasına yollayalım.
       if($url[0] == ""){

          header('Location: /'.HOME_URL);

       }


        if(file_exists("Controller/".ucwords($url[0])."Controller.php")){

            $this->CurrentController = ucwords($url[0]."Controller");

            unset($url[0]);



            //controller'i import edelim
            require_once "Controller/". $this->CurrentController .".php";

            $this->CurrentController = new $this->CurrentController;


            //gelen fonksiyon degerini alalım.
            if(isset($url[1])){

                //şuanki Controller'de url[1]'den gelen fonksion varmı
                if(method_exists($this->CurrentController,$url[1])){

                    $this->CurrentMethod = $url[1];



                    //gelen data varsa onuda CurrentDataya atalım.
                    $this->CurrentData = $url[2] ? array_values($url):[];



                    //Controller'daki methodu çalıştıralım ve varsa datayı yollayalım.
                    call_user_func_array(array($this->CurrentController,$this->CurrentMethod),array($this->CurrentData));


                    unset($url[1]);
                    unset($url);

                }else{


                    if(ERROR_REPORTING == 1){

                        $publish->ErrorPublish("Fonksiyon Bulunamadı","Controller  altında ".($url[1])."() adında bir fonksiyon tanımlı değil.");

                    }else{

                        $publish->_404();
                    }


                }

            }else{


                //eğer fonksiyon yok ise Controller'daki default fonksiyonuna yollayalım.

                $this->CurrentMethod = "default";

                //gelen data varsa onuda CurrentDataya atalım.
                $this->CurrentData = $url[1] ? array_values($url):[];

                //Controller'daki methodu çalıştıralım ve varsa datayı yollayalım.
                call_user_func_array(array($this->CurrentController,$this->CurrentMethod),array($this->CurrentData));

            }

        }else{

            if(ERROR_REPORTING == 1){

            $publish->ErrorPublish("Controller Bulunamadı","Controller klasörü altında ".ucwords($url[0])."Controller.php adında bir dosya bulunamadı.");

             }else{

                $publish->_404();
            }
        }










    }


    public function GetUrl(){
        //eğer url değeri GET edilir ise. .htaccess tarafından browser'daki url kısmına girilen bütün değerler buraya ($_GET["url"]) gelecektir.
       if(isset($_GET["url"])){

           //sağdaki boşlukları silelim
           $array = rtrim($_GET["url"],"/");

           //gelen degerin url yapısına uygun olup olmadığını kontrol edelim
           $array = filter_var($array,FILTER_SANITIZE_URL);

           //url'li parçalayalım.
           $array = explode("/",$array);

           //örnek adres çubuğu; http://abc2.local:8888/blog/yazilar/deneme-yazi1
           //geriye dönen değer; array ( 0 => 'blog', 1 => 'yazilar', 2 => 'deneme-yazi1', )
           return $array;

       }
    }//GetUrl

}//class
?>