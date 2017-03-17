<?php
    require_once '../../Core/Modelo/class.conection.php';
    require_once '../../Core/Modelo/class.consultations.php';

    // Eliminar post
session_start();
if(!isset($_SESSION['root'])){
    header('location: ../Admin/blog.php');
}else{
    if(isset($_GET['id_blog'])){
        $id = $_GET['id_blog'];
        $modelo = new Consultations();
        $result = $modelo->deletePost($id);
        header('location: ../Admin/blog.php');
    }
}