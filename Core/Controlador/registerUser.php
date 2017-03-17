<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    $modelo     = new Conection();
    $consult    = new Consultations();
    $connect    =  $modelo->get_conection();
    $query      = "SELECT users,email FROM users WHERE users = :users OR email = :email LIMIT 1;";
    $stm        = $connect->prepare($query);
    $user       = htmlentities(addslashes($_POST['user']));
    $email      = htmlentities(addslashes($_POST['email']));
    $stm->bindValue(':users',$user);
    $stm->bindValue(':email',$email);
    $stm->execute();
    $count      = $stm->rowCount();
    $rows       = $stm->fetch(PDO::FETCH_ASSOC);
    if($count == 0){
        $pass       = htmlentities(addslashes($_POST['passwd']));
        $pass_sha1  = $consult->Encrypt($pass);
        $date       = date('Y/m/d h:i:s a');
        $modelo     = new Consultations();
        $result     = $modelo->insertUsersRegistrys($user,$pass_sha1,$email,$date);
            mail($email,'informatic-Death','<h1>Hola<h1><strong> '.$user. '</strong>, Una recomendación, evita el mal úso de la información que recopiles aquí. Gracias por su atención.<br><br><strong>Usuario:</strong> '.$user.'<br><strong>Contraseña:</strong> '.$pass);
        $HTML = 1;
    }else{
        if(strtolower($rows['users']) == strtolower($user)){
            $HTML = '<div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>ERROR!</strong> El usuario '.$user.' ya existe.
                     </div>';
        }
        if(strtolower($rows['email']) == strtolower($email)){
            $HTML = '<div class="alert alert-dismissible alert-danger">
                       <button type="button" class="close" data-dismiss="alert">x</button>
                       <strong>ERROR!</strong> El email '.$email.' ya existe.
                    </div>';
        }
    }
    echo $HTML;