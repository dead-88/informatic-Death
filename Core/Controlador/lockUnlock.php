<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    session_start();
    $consult    = new Consultations();
    $connection = new Conection();
    $connect    = $connection->get_conection();
    $user       = $consult->session();

    if(isset($_POST['select'],$_POST['block']) && $_POST['select'] == 'block'){
        $bloquear = $_POST['block'];
        if(isset($bloquear)){
            if($user[0]['block'] == ''){
                $bloquear   = implode(',', $bloquear);
            }else{
                $blockMas   = implode(',', $bloquear);
                $bloquear   = $user[0]['block'].','.$blockMas;
            }
            $updateBlock    = $connect->prepare("UPDATE `users` SET `block` = ? WHERE `id_users` = ?");
            if($updateBlock->execute(array($bloquear, $_SESSION['id_user']))){
                $response = '<h2>Usuarios Bloqueados</h2>';
                $response = stripslashes($response);
                echo ($response);
            }
        }
    }

    if(isset($_POST['select'],$_POST['desblock']) && $_POST['select'] == 'desblock'){
        $blockArray = explode(',', $user[0]['block']);
        $desblock   = $_POST['desblock'];
        if(isset($desblock)){
            foreach($desblock as $indice => $val){
                if(in_array($val, $blockArray)){
                    $indiceLans = array_search($val, $blockArray);
                    unset($blockArray[$indiceLans]);
                }
            }
        }
        $newBlock = implode(',', $blockArray);
        $updateBlock = $connect->prepare("UPDATE `users` SET `block` = ? WHERE `id_users` = ?");
        if($updateBlock->execute(array($newBlock, $_SESSION['id_user']))){
            $response = '<h2>Usuarios Desloqueados</h2>';
                $response = stripslashes($response);
                echo ($response);
        }
    }
?>