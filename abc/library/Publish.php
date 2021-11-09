<?php

/*
 *  abc Framework v2
 *  Ekrana framework'e ait uyarıları, hataları basmak için kullanılır.
 *
 *  Created by Okan Bahadır Soygür
 *
*/

class Publish{


    public function ErrorPublish($title,$content){

        echo "<div class=\"\" style=\"border:1px solid gray; max-width: 100%;\">
  <div style='color: coral;' class=\"\"><h4><b><center>Framework Hatası | abc Framework</center></b></h4><hr/></div>
 
  <div style='margin-left: 20px;  margin-bottom: 20px;' class=\"\">
    <h4 style=' '>Hata Tipi: ".$title."</h4>
   <b> <p class=\"\">Hata Mesajı: ".$content."<br/></b><br/>
 
   <button style='cursor: pointer;'  onclick='geri()'>Geri</button> 
    <a href='".SITE_URL."'> <button style='cursor:pointer;' >Ana Sayfa</button> </a>
  </div>
  
</div> <script>
    function geri(){

        window.history.back();

    }

</script>";

    }//ErrorPublish


    public function _404(){
        echo "<center>404 Not Found</center>";
    }


}//class

?>