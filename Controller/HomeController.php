<?php

class HomeController extends Controller {


    function default($deger){


        $this->View("HomeController/Home","","Ana Sayfam","anasayfa");
       echo "default controller page || abc Framework</br>";

       echo Security::htmlJavascriptClear("<hr><h1>MERHABA</h1>");

        echo "</br>";

        echo Security::sqlInjectionClear("select id, title from hayvanlar where id = \"12\";");


        //$Deneme = $this->Model("Deneme");

      //  var_export($Deneme->degergetir());

       // var_export($deger);
    }

    function blog($data=0){
        echo "blog page || abc Framework";

    }

    function login($data){

        //var_export($query);

        $this->View("HomeController/login",$data);

    }

    function welcome(){
     // echo "welcome page || abc Framework";

     //$class=  $this->Model("Deneme");

    // $class->aq(" || sa");

        $db = new Database();
        print_r( $db->one_row("select * from hayvanlar where kupeNo = 123456789"));


      //  $db->x("insert into rastgele_veriler_tablosu (string1) VALUES('BAHO');");
       // var_export($re);




    }

}


?>