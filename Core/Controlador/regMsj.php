<?php

    require_once '../Modelo/class.conection.php';

    if(isset($_POST['message'])){
        $connection = new Conection();
        $connect    = $connection->get_conection();

        $message    = $_POST['message'];
        $de         = (int)htmlentities(addslashes($_POST['de']));
        $para       = (int)htmlentities(addslashes($_POST['para']));

        var_dump($message);
        if($message != ''){
            $insert     = $connect->prepare("INSERT INTO `messages` (id_de,id_para,message,date_registry,visto) VALUE(?,?,?,?,?)");

            $arrayInsert= array($de,$para,$message, time(), 0);
            if($insert->execute($arrayInsert)){
                echo 'ok';
            }else{
                echo 'no';
            }
        }
    }