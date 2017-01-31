<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    $modelo = new Conection();
    $connect =  $modelo->get_conection();
    $query = "SELECT users,email FROM users WHERE users = :user OR email = :email LIMIT 1;";
    $stm = $connect->prepare($query);
    $user = htmlentities(addslashes($_POST['user']));
    $email = htmlentities(addslashes($_POST['email']));
    $stm->bindValue(':user',$user);
    $stm->bindValue(':email',$email);
    $stm->execute();
    $row = $stm->rowCount();
//    var_dump($row);
    if($row == 0){
        $pass = htmlentities(addslashes($_POST['pass']));
        $pass_sha1 = sha1($pass);
        $ip_users = $_SERVER['REMOTE_ADDR'];
        $date = date('Y/m/d  h:i:s');
        $modelo = new Consultations();
        $result = $modelo->insertUsersRegistrys($user,$pass_sha1,$email,$ip_users,$date);
        $HTML = 1;
    }else{
        $HTML = '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>ERROR:</strong> El email o el usuario ingresado ya existe.
                 </div>';
    }
    echo $HTML;