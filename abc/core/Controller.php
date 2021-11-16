<?php

class Controller{




    public function Model($model){

        require_once "Model/".$model.".php";

        return new $model;

    }


    public function View($view,$data=[],$pageTitle="View",$description="abc Framework", $keywords="abc Framework"){



        if(file_exists("View/".$view.".view.php")){

                //view'e html sayfa bilgisi tag'larını ekleyelim.(header,page title ...)
                $html = new Html($pageTitle,$description,$keywords);


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