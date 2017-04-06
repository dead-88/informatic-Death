<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    session_start();
    date_default_timezone_set('America/Bogota');

    $userConv   = htmlentities(addslashes($_POST['userConvers']));
    $message    = htmlentities(addslashes($_POST['message']));
    $date       = date('Y/m/d h:i:s a');
    $idUser     = htmlentities(addslashes($_POST['idUser']));

    $conection  = new Conection();
    $consult    = new Consultations();
    $connect    = $conection->get_conection();

    if(isset($_SESSION['usuario']) OR isset($_SESSION['root'])){
        if(isset($_SESSION['root'])){
            // Array de los admin
            $admin = $connect->prepare("SELECT * FROM admin WHERE id_admin = :uiadm");
            $admin->execute(array(":uiadm"=>$_SESSION['root']));
            $adminView = $admin->fetch(PDO::FETCH_ASSOC);

            if($adminView['user_admin'] == $userConv){
                if(strlen($userConv) > 0 && strlen($message) > 0 && strlen($idUser) > 0){
                    $result = $consult->insertMessage($idUser, $userConv, $message, $date);
                }else{
                    echo "Error campos vacios";
                }
            }
        }else if(isset($_SESSION['usuario'])){
            // Ver el registro completo del usuario que ingreso.
            $stm = $connect->prepare("SELECT * FROM `users` WHERE `users` = ?");
            $stm->execute(array($_SESSION['usuario']));
            $user = $stm->fetch();
            // Fin registros

            if($user['users'] === $userConv && $user['id_users'] == $idUser){
                if(strlen($userConv) > 0 && strlen($message) > 0 && strlen($idUser) > 0){
                    $result = $consult->insertMessage($idUser, $userConv, $message, $date);
                }else{
                    echo "Error campos vacios";
                }
            }
        }
    }