<?php

    require_once '../Modelo/class.conection.php';
    date_default_timezone_set('America/Bogota');

     session_start();
     $online        = isset($_SESSION['usuario']);
        $modelo     = new Conection();
        $connect    = $modelo->get_conection();
        $dateSalida = date('Y/m/d  h:i:s a');

    // seleccionar el ultimo id del usuario que ingreso en la tabla logs, para registar su salida.
    $stms = $connect->prepare("SELECT id,user FROM logs WHERE id = (SELECT max(id) from logs)");
    $stms->execute();
    $userId = $stms->fetch(PDO::FETCH_ASSOC);
    // Fin seleccion

    $id = $userId['id'];

    $insertSalida = $connect->prepare("UPDATE logs set salida_users = '$dateSalida' WHERE id = '$id'");
    $insertSalida->execute();

//    Actualizar el online a 0 para off line
//    $queryTwo   = "UPDATE users set online = '0' WHERE id_users = '".$online."';";
//    $stmTwo     = $connect->prepare($queryTwo);
//    $stmTwo->execute();
    session_unset();
    session_destroy();
     header('location: ../../index.php');