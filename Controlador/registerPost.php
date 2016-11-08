<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    date_default_timezone_set('America/Bogota');
    $title = htmlentities(addslashes($_POST['title']));
    $description = htmlentities(addslashes($_POST['description']));
    $img = htmlentities(addslashes($_POST['img']));
    $date = date('Y-m-d h:i:s');
    $autor = htmlentities(addslashes($_POST['autor']));
    $ip = $_SERVER['REMOTE_ADDR'];

    if(strlen($img) > 0 && strlen($title) > 0 && strlen($date) > 0 && strlen($autor) > 0 && strlen($description) > 0){
        $modelo = new Consultations();
        $result = $modelo->insertPost($title, $description, $img, $date,$autor, $ip);
        header('location:../Admin/blog.php');
    }