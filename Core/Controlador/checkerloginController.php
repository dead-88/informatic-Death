<?php

    require_once '../Modelo/class.conection.php';

    try{
        $modelo = new Conection();
        $connect = $modelo->get_conection();
        $query = "SELECT users.id_users,users.users,users.password,users.email,users.ip_user FROM users WHERE (users = :login OR email = :login) && password = :passwd";
        $stm = $connect->prepare($query);
        $login = htmlentities(addslashes($_POST['login']));
        $pass = htmlentities(addslashes($_POST['passwd']));
        $passS = sha1($pass);
        $stm->bindValue(':login',$login);
        $stm->bindValue(':passwd',$passS);
        $stm->execute();
        $number_registry = $stm->rowCount();
        if($number_registry != 0){
            session_start();
            $_SESSION['usuario'] = $_POST['login'];
            $entrada = date('Y/m/d h:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $query = "INSERT INTO logs(entrada_users,user,ip) VALUES ('$entrada','$login','$ip')";
            $stm = $connect->prepare($query);
            $stm->execute();
            header('location: ../../Acceso/index.php');
        }else{
            header('location: ../../index.php');
        }
    }catch(PDOException $e){
        die("Error al conectar con la base de datos: ".$e->getMessage());
    }