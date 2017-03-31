<?php

    require_once '../../Core/Modelo/class.conection.php';
    require_once '../../Core/Modelo/class.consultations.php';

    session_start();
    $modelo     = new Conection();
    $consult    = new Consultations();
    $login      = htmlentities(addslashes($_POST['login']));
    $connect    = $modelo->get_conection();
    $pass       = htmlentities(addslashes($_POST['passwd']));
    $passS      = $consult->Encrypt($pass);
    try{
        $stm    = $connect->prepare("SELECT id_admin,user_admin,password FROM admin WHERE user_admin = :login");
        $stm->execute(array(":login"=>$login));
        $row    = $stm->fetch(PDO::FETCH_ASSOC);
        $count  = $stm->rowCount();

        if($row['password'] == $passS){
            if($count != 0){
                $_SESSION['root'] = $row['id_admin'];
                $entrada = date('Y/m/d h:i:s a');
                $query = "INSERT INTO logs(entrada_users,user) VALUES ('$entrada','$login')";
                $stm = $connect->prepare($query);
                $stm->execute();
                // var_dump($stm);
                header('location: ../Admin/blog.php');
            }else{
                header('location: ../Admin/index.php');
            }
        }else{
            header('location: ../Admin/index.php');
        }

    }catch(Exception $r){
        die("Error al conectar a la base de datos: ".$r->getMessage());
    }
