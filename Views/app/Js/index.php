<?php

require_once '../../../Core/Modelo/class.conection.php';
require_once '../../../Core/Modelo/class.consultations.php';

session_start();
if(!isset($_SESSION['root'])){
    header('location:../index.php');
}