<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

// Eliminar Mensajes de usuarios
session_start();
if(!isset($_SESSION['id_user'])){
    header('location: ../Acceso/index.php');
}else{
    if(isset($_GET['id_conversations'])){
        $id         = $_GET['id_conversations'];
        $modelo     = new Consultations();
        $session    = $modelo->session();
        if($session[0]['rango'] >= 2){
            $result = $modelo->deletemsj($id);
        }
    }
}
