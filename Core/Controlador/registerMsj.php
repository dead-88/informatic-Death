<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    session_start();
    date_default_timezone_set('America/Bogota');
    $user = htmlentities(addslashes($_POST['userConvers']));
    $message = htmlentities(addslashes($_POST['message']));
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('Y/m/d  h:i:s a');

    if($_SESSION['usuario'] === $_POST['user'] OR $_SESSION['root'] === $_POST['user']){
        if(strlen($user) > 0 && strlen($message) > 0){
            $modelo = new Consultations();
            $result = $modelo->insertMessage($user,$message,$ip,$date);
            header('location: ../../index.php');
        }else{
            return "Error";
        }
    }