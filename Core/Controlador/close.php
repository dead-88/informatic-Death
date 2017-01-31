<?php

    require_once '../Modelo/class.conection.php';
    date_default_timezone_set('America/Bogota');

     session_start();
        $modelo = new Conection();
        $connect = $modelo->get_conection();
        $dateSalida = date('Y/m/d  h:i:s a');

    // Array del usuario que ingreso
    $stms = $connect->prepare("SELECT id,user FROM logs WHERE id = (SELECT max(id) from logs)");
    $stms->execute();
    $userId = $stms->fetch(PDO::FETCH_ASSOC);
    // Fin array

    $id = $userId['id'];


    $insertSalida = $connect->prepare("UPDATE logs set salida_users = '$dateSalida' WHERE id = '$id'");
        $insertSalida->execute();
     session_destroy();
     header('location: ../../index.php');