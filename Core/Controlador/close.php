<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';
    date_default_timezone_set('America/Bogota');

    session_start();
    $consult       = new Consultations();
    $connection    = new Conection();
    $connect       = $connection->get_conection();
    $dateSalida    = date('Y/m/d h:i:s a');

    // seleccionar la sesion del usuario, para registar su salida.
    $session        = $consult->session();
    $id_user        = $session[0]['id_users'];
    // Fin seleccion

    $insertSalida = $connect->prepare("UPDATE logs set salida_users = '$dateSalida' WHERE id = :id");
    $insertSalida->bindParam(':id',$id_user);
    $insertSalida->execute();

    session_unset($_SESSION['usuario']);
    session_unset($_SESSION['id_user']);
    session_destroy();
    header('location: ../../index.php');
  
    // seleccionar el ultimo id del usuario que ingreso en la tabla logs, para registar su salida.
   /*stms = $connect->prepare("SELECT id,id_users FROM logs WHERE id_users = (SELECT max(id_users) from logs)");
   $stms->execute();
   $userId  = $stms->fetch(PDO::FETCH_ASSOC);
   $iduser  = $userId['id_users'];
   var_dump($userId);*/
    // Fin seleccion