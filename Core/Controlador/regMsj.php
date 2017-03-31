<?php

    require_once '../Modelo/class.conection.php';

    if(isset($_POST['message'])){
        $connection = new Conection();
        $connect    = $connection->get_conection();

        $message    = strip_tags(trim(filter_input(INPUT_POST,'message',FILTER_SANITIZE_STRING)));
        $de         = (int)htmlentities(addslashes($_POST['de']));
        $para       = (int)htmlentities(addslashes($_POST['para']));


        if($message != ''){
            $insert     = $connect->prepare("INSERT INTO `messages` (id_de,id_para,message,date_registry,visto) VALUE(?,?,?,?,?)");
            $arrayInsert= array($de,$para,$message, time(), 0);
//            var_dump($arrayInsert);
            if($insert->execute($arrayInsert)){
                echo 'ok';
            }else{
                echo 'no';
            }
        }
    }