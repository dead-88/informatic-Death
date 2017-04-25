<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


// Eliminar Usuarios
session_start();
if(!isset($_SESSION['id_user'])){
    header('location: ../Acceso/index.php');
}else{
    if(isset($_GET['id_users'])){
        $id         = $_GET['id_users'];
        $consult    = new Consultations();
        $session    = $consult->session();
        if($session[0]['rango'] >= 2){
            $result = $consult->deleteUsers($id);
            header('location: ../Acceso/index.php');
        }
    }
}
