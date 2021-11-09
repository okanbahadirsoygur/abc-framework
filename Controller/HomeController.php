<?php

class HomeController extends Controller {


    function default(){
        echo "default controller page || abc Framework";
    }

    function blog( $data=0){
        echo "blog page || abc Framework";

    }

    function login($data){

        //var_export($query);

        $this->View("HomeController/login",$data);

    }

    function welcome(){
        echo "welcome page || abc Framework";
    }

}


?>