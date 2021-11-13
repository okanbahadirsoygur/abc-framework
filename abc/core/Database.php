<?php

class  Database{

    private $user;
    private $pass;
    private $dsn;
    private $PDO;


     function __construct()
    {

        $this->dsn = DATABASE_PDO_TYPE.":host=".HOSTNAME.":".PORT.";port=".PORT.";dbname=".DATABASE."";

        $this->user = USER;
        $this->pass = PASSWORD;

        $this->PDO = new PDO($this->dsn, $this->user, $this->pass);



    }


    public function n_row($sql){

        $result = $this->PDO->query($sql);
         $result->execute();

        $rows =  $result->fetchAll();

        return $rows;

    }


    public function one_row($sql){

        $result = $this->PDO->prepare($sql);

        $result->execute();

        $row =  $result->fetch();

        return $row;

    }


    public function x($sql){


       $result = $this->PDO->prepare($sql);

       $result->execute();

       return $result;

    }


}

?>