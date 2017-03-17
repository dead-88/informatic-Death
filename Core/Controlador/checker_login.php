<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    $modelo     = new Conection();
    $consult    = new Consultations();
    $login      = htmlentities(addslashes($_POST['login']));
    $connect    = $modelo->get_conection();
    $pass       = htmlentities(addslashes($_POST['passwd']));
    $passS      = $consult->Encrypt($pass);
    try{
        $stm    = $connect->prepare("SELECT users.id_users,users.users,users.password,users.email FROM users WHERE (users = :login OR email = :login)");
        $stm->execute(array(":login"=>$login));
        $row    = $stm->fetch(PDO::FETCH_ASSOC);
        $count  = $stm->rowCount();

        if($row['password'] == $passS){
            if($count != 0){
                session_start();
                $_SESSION['usuario']    = $row['id_users'];
                $id_user                = $row['id_users'];

                $entrada    = date('Y/m/d h:i:s a');
                $query      = "INSERT INTO logs(id_users,entrada_users,user) VALUES ('$id_user','$entrada','$login')";
                $stm        = $connect->prepare($query);
                $stm->execute();

                $queryTwo   = "UPDATE users set online = '1' WHERE id_users = '".$_SESSION['usuario']."';";
                $stmTwo     = $connect->prepare($queryTwo);
                $stmTwo->execute();
                header('location:../Acceso/index.php');
            }else{
                header('location: ../../index.php');
            }
        }else{
            header('location: ../../index.php');
        }
    }catch(PDOException $e){
        die("Error de conexión: ".$e->getMessage());
    }
