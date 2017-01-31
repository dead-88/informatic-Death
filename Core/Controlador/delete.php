<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    if(isset($_GET['id_blog'])){
        $id = $_GET['id_blog'];
        $modelo = new Consultations();
        $result = $modelo->delete($id);
        header('location: ../../CoreRoot/Admin/blog.php');
    }