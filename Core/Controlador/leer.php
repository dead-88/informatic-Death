<?php

    require_once '../Modelo/class.conection.php';

    if(isset($_POST['leer'])) {
        $connection = new Conection();
        $connect = $connection->get_conection();

        $online     = (int)htmlentities(addslashes($_POST['online']));
        $user       = (int)htmlentities(addslashes($_POST['user']));

        $update     = $connect->prepare("UPDATE `messages` SET `visto` = 1 WHERE `id_de` = ? AND `id_para` = ?");
        if($update->execute(array($online, $user))){
            echo 'ok';
        }else{
            echo 'no';
        }
    }