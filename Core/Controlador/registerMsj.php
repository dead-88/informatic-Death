<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    session_start();
    date_default_timezone_set('America/Bogota');

    $userConv   = htmlentities(addslashes($_POST['userConvers']));
    $message    = htmlentities(addslashes($_POST['message']));
    $date       = date('Y/m/d h:i:s a');
    $idUser     = htmlentities(addslashes($_POST['idUser']));

    $conection  = new Conection();
    $consult    = new Consultations();
    $connect    = $conection->get_conection();
    $user       = $consult->session();

    if(isset($_SESSION['usuario'],$_SESSION['id_user'])){
        if($user[0]['users'] === $userConv && $user[0]['id_users'] === $idUser){
            if(strlen($userConv) > 0 && strlen($message) > 0 && strlen($idUser) > 0){
                $result = $consult->insertMessage($idUser, $userConv, $message, $date);
            }else{
                $msj = "¡ERROR! Campos vacios.";
            }
            echo $msj;
        }
    }