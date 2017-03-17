<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    session_start();
    date_default_timezone_set('America/Bogota');

    $userConv = htmlentities(addslashes($_POST['userConvers']));
    $message = htmlentities(addslashes($_POST['message']));
    $date = date('Y/m/d  h:i:s a');
    $idUser = htmlentities(addslashes($_POST['idUser']));

    $conection = new Conection();
    $connect = $conection->get_conection();

    if(isset($_SESSION['usuario']) OR isset($_SESSION['root'])){
        if(isset($_SESSION['root'])){
            // Array de los admin
            $admin = $connect->prepare("SELECT * FROM admin WHERE id_admin = :uiadm");
            $admin->execute(array(":uiadm"=>$_SESSION['root']));
            $adminView = $admin->fetch(PDO::FETCH_ASSOC);

            if($adminView['user_admin'] == $userConv){
                if(strlen($userConv) > 0 && strlen($message) > 0 && strlen($idUser) > 0){
                    $consultations = new Consultations();
                    $result = $consultations->insertMessage($idUser,$userConv,$message,$date);
                }else{
                    return "Error campos vacios";
                }
            }
        }else if(isset($_SESSION['usuario'])){
            // Array de los usuarios
            $stm = $connect->prepare("SELECT * FROM users WHERE id_users = :uid");
            $stm->execute(array(":uid"=>$_SESSION['usuario']));
            $user = $stm->fetch(PDO::FETCH_ASSOC);

            if($user['users'] === $userConv && $user['id_users'] == $idUser){
                if(strlen($userConv) > 0 && strlen($message) > 0 && strlen($idUser) > 0){
                    $consultations = new Consultations();
                    $result = $consultations->insertMessage($idUser,$userConv,$message,$date);
                }else{
                    return "Error campos vacios";
                }
            }
        }
    }