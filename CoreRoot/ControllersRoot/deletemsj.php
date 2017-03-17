<?php
require_once '../../Core/Modelo/class.conection.php';
require_once '../../Core/Modelo/class.consultations.php';

// Eliminar Mensajes de usuarios
session_start();
if(!isset($_SESSION['root'])){
    header('location: ../Admin/blog.php');
}else{
    if(isset($_GET['id_conversations'])){
        $id = $_GET['id_conversations'];
        $modelo = new Consultations();
        $result = $modelo->deletemsj($id);
    }
}