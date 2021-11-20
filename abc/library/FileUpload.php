<?php

/*
 *  abc Framework v2
 *  Dosya sistemine, türlerine göre wwwroot/uploads klasörü altında dosya yüklemek için hazırlanmıştır.
 * 
 *  Created by Okan Bahadır Soygür
 *
*/

class FileUpload{


    private $FILE;

    public function __construct($FILE)
    {

        $this->FILE = $FILE;

    }

    private $img_types = ["jpeg","png","jpg"];
    private $video_types = ["jpeg","png","jpg"];
    private $sound_types = ["mp3","ogg","aac","wav","flac","alac","dsd"];
    private $document_types = ["pdf","doc","docx","xls","xlsx","ppt","pptx","ods","odt","txt","html","csv","xml","json"];
    private $file_types = ["exe","app","apk","iso","zip","rar","7zip"];


    // type değerleri şunlardır;
    // img, document, sound, file, video
    // Her type değeri için yukarıda izin verilen uzantılar vardır.Type değerleri için bleirtilen uzantılar haricinde yüklenmek istenen her dosya reddedilecektir.
    // Her type değeri wwwroot/uploads klasöründeki ilgili yere aktarılır.
    // yüklenen dosyaların kendi isimlerinden sonra, çakışmaları önlemek için o anki sistem saati isminin sonuna eklenir.
    // başarıyla yüklenen dosyalar için url bilgisi geriye döndürülür, başarısız olur ise hata ve açıklaması geriye döndürülür.
     public  function upload($HtmlFileElementId,$type){



        if(isset($this->FILE[$HtmlFileElementId])){

            $errors= array();
            $file_name = $this->FILE[$HtmlFileElementId]['name'];

            $file_size =$this->FILE[$HtmlFileElementId]['size'];
            $file_tmp =$this->FILE[$HtmlFileElementId]['tmp_name'];
            $file_type= $this->FILE[$HtmlFileElementId]['type'];

            $array = explode('.', $this->FILE[$HtmlFileElementId]['name']);
            $file_ext = strtolower(end($array));//yüklenen dosyanın uzantısını alalım.


            //gelen dosya uzantısının bizim desteklediğimiz tiplerde olup olmadığını kontrol edelim.



            switch ($type){


                case "img":

                    $system_folder = "img";

                    //gelen dosya uzantısı desteklenen uzantılar dizisinde yok ise hata mesajını dolduralım
                    if(in_array($file_ext,$this->img_types) === false){

                        $a["baslik"] = "Hata";
                        $a["icerik"] = "Yüklenen dosya img türüne ait bir dosya uzantısı değildir.";

                    }

                break;


                case "document":

                    $system_folder = "document";

                    if(in_array($file_ext,$this->document_types) === false){

                        $a["baslik"] = "Hata";
                        $a["icerik"] = "Yüklenen dosya document türüne ait bir dosya uzantısı değildir.";

                    }

                break;


                case "file":

                    $system_folder = "file";

                    if(in_array($file_ext,$this->file_types) === false){

                        $a["baslik"] = "Hata";
                        $a["icerik"] = "Yüklenen file document türüne ait bir dosya uzantısı değildir.";

                    }

                break;


                case "video":

                    $system_folder = "video";

                    if(in_array($file_ext,$this->video_types) === false){

                        $a["baslik"] = "Hata";
                        $a["icerik"] = "Yüklenen video document türüne ait bir dosya uzantısı değildir.";

                    }

                break;



                case "sound":

                    $system_folder = "sound";

                    if(in_array($file_ext,$this->sound_types) === false){

                        $a["baslik"] = "Hata";
                        $a["icerik"] = "Yüklenen sound document türüne ait bir dosya uzantısı değildir.";

                    }

                break;


                default:

                    $a["baslik"] = "Hata";
                    $a["icerik"] = "Desteklenmeyen tip değeri belirttiniz!";

                break;
            }




            //eğer hiç hata mesajı almamış isek, dosyayı yükleyelim.
            if(empty($a) === true || $a === null){

                move_uploaded_file($file_tmp,"wwwroot/uploads/".$system_folder."/".time()."-".$file_name);

                $a["baslik"] = "Başarılı";
                $a["icerik"] = "Dosya başarıyla yüklendi";
                $a["url"] = SITE_URL."wwwroot/uploads/".$system_folder."/".time()."-".$file_name;

                return $a;

            }else{
                //eğer her hangi bir hata almış isek geriye hata mesajını döndürelim.

                return $a;

            }


        }else{
            $a["baslik"] = "Hata";
            $a["icerik"] = "Belirtilen html elementinin tipi file değil yada hiç bir dosya seçilmedi.";
            return $a;
        }

    }// func upload


}//class


?>