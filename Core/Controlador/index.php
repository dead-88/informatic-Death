<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

session_start();
if(!isset($_SESSION['root'])){
    header('location: ../Acceso/index.php');
}