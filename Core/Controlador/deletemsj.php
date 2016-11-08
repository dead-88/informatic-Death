<?php
require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

if(isset($_GET['id_conversations'])){
    $id = $_GET['id_conversations'];
    $modelo = new Consultations();
    $result = $modelo->deletemsj($id);
    header('location:../Admin/blog.php');
}