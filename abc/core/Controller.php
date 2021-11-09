<?php

class Controller{




    public function Model($model){

        require_once "Model/".$model.".php";

        return $model;

    }


    public function View($view,$data=[]){


        if(file_exists("View/".$view.".view.php")){

                require_once "View/".$view.".view.php";

        }else{
            if(ERROR_REPORTING == 1){

                $publish = new Publish();
                $publish->ErrorPublish("View Bulunamadı","View klasörü altında ".$view.".view.php adında bir dosya bulunamadı.");

            }
        }


    }

}

?>