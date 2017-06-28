<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    $modelo     = new Conection();
    $consult    = new Consultations();
    $connect    = $modelo->get_conection();
    $email      = strip_tags(trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING)));
    $login      = htmlentities(addslashes($_POST['login']));
    $pass       = htmlentities(addslashes($_POST['passwd']));
    $passS      = $consult->Encrypt($pass);
    try{
        $stm    = $connect->prepare("SELECT users.id_users,users.users,users.password,users.email FROM users WHERE users = :login");
        $stm->execute(array(":login"=>$login));
        $row    = $stm->fetch(PDO::FETCH_ASSOC);
        $count  = $stm->rowCount();

        if($row['password'] == $passS){
            if($count != 0){
                session_start();

                $pegaUser = $connect->prepare("SELECT * FROM `users` WHERE `users` = ?");
                $pegaUser->execute(array($email));

                $ahora  = date('Y-m-d H:i:s');
                $limite = date('Y-m-d H:i:s', strtotime('+2 min'));
                $update = $connect->prepare("UPDATE `users` SET `online` = ?, `limite` = ? WHERE `users` = ?");
                if($update->execute(array($ahora, $limite, $email))){
                    while($rows = $pegaUser->fetchObject()){
                        $_SESSION['usuario']    = $email;
                        $_SESSION['id_user']    = $rows->id_users;
                        $id_user                = $row['id_users'];

                        $entrada    = date('Y/m/d h:i:s a');
                        $query      = "INSERT INTO logs(id_users,entrada_users,user) VALUES ('$id_user','$entrada','$login')";
                        $stm        = $connect->prepare($query);
                        $stm->execute();
                        header('location: ../Acceso/index.php');
                    }
                }
            }else{
                header('location: ../../index.php');
            }
        }else{
            header('location: ../../index.php');
        }
    }catch(PDOException $e){
        die("Error de conexión: ".$e->getMessage());
    }
