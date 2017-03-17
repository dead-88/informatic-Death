<?php
require_once '../../Core/Modelo/class.conection.php';
require_once '../../Core/Modelo/class.consultations.php';


// Eliminar Usuarios
session_start();
if(!isset($_SESSION['root'])){
    header('location: ../Admin/blog.php');
}else{
    if(isset($_GET['id_users'])){
        $id = $_GET['id_users'];
        $modelo = new Consultations();
        $result = $modelo->deleteUsers($id);
        header('location: ../Admin/blog.php');
    }
}
