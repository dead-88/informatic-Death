<?php

    require_once '../Modelo/class.conection.php';

    session_start();
    $modelo = new Conection();
    $connect = $modelo->get_conection();
    $login = htmlentities(addslashes($_POST['login']));
    $pass = htmlentities(addslashes($_POST['passwd']));
    $passS = sha1($pass);
    try{
        $stm = $connect->prepare("SELECT users.id_users,users.users,users.password,users.email,users.ip_user FROM users WHERE (users = :login OR email = :login)");
        $stm->execute(array(":login"=>$login));
        $row = $stm->fetch(PDO::FETCH_ASSOC);

        $count = $stm->rowCount();
        if($row['password'] == $passS){
            if($count != 0){
                $_SESSION['usuario'] = $row['id_users'];
                $entrada = date('Y/m/d h:i:s');
                $ip = $_SERVER['REMOTE_ADDR'];
                $query = "INSERT INTO logs(entrada_users,user,ip) VALUES ('$entrada','$login','$ip')";
                $stm = $connect->prepare($query);
                $stm->execute();
                header('location:../Acceso/index.php');
            }else{
                header('location:../index.php');
            }
        }else{
            header('location:../index.php');
        }
    }catch(PDOException $e){
        die("Error al conectar con la base de datos: ".$e->getMessage());
    }