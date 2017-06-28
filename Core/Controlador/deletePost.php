<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

// Eliminar post
session_start();

if(!isset($_SESSION['id_user'])){
    header('location: ../Acceso/index.php');
}else{
    if(isset($_GET['id_blog'])){
        $id     = $_GET['id_blog'];
        $modelo = new Consultations();
        $session= $modelo->session();
        if($session[0]['rango'] >= 2){
            $result = $modelo->deletePost($id);
            header('location: ../Acceso/index.php');
        }else{
            header('location: ../Acceso/index.php');
        }
    }
}