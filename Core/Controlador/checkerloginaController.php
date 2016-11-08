<?php

    require_once '../Modelo/class.conection.php';

    try{
        $modelo = new Conection();
        $connect = $modelo->get_conection();
        $query = "SELECT id_admin,user_admin,password,ip FROM admin WHERE user_admin = :login && password = :passwd";
        $stm = $connect->prepare($query);
        $login = htmlentities(addslashes($_POST['login']));
        $pass = htmlentities(addslashes($_POST['passwd']));
        $passS = sha1($pass);
        $stm->bindValue(':login', $login);
        $stm->bindValue(':passwd', $passS);
        $stm->execute();
        $rows = $stm->rowCount();
        if($rows!=0){
            session_start();
            $_SESSION['root'] = $_POST['login'];
            $entrada = date('Y/m/d h:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];
            $query = "INSERT INTO logs(entrada_users,user,ip) VALUES ('$entrada','$login','$ip')";
            $stm = $connect->prepare($query);
            $stm->execute();
            header('location:../Admin/blog.php');
        }else{
            header('location:../Admin/index.php');
        }

    }catch(Exception $r){
        die("Error al conectar a la base de datos: ".$r->getMessage());
    }