<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

session_start();
if(!isset($_SESSION['root'])){
    header('location:../index.php');
}else{
    $modelo = new Consultations();
    $conversations = $modelo->view();
    if(isset($conversations)){
        foreach($conversations as $conversation){}
    }
}