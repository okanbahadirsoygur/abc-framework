<?php

class  Deneme{

private $Database;


    public function __construct()
    {


        $this->Database = new Database();


    }

    function degergetir(){

        $deger = $this->Database->n_row("select * from hayvanlar");
        return $deger;
        }
}

?>