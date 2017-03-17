<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


if(isset($_GET['id_users']) && !empty($_GET['id_users'])){
    $id_users   = htmlentities(addslashes($_GET['id_users']));
    $consult    = new Consultations();
    $connection = new Conection();
    $connect    = $connection->get_conection();
    $results    = $consult->viewUsersById($id_users);

    //Ver todos los mensajes que ah enviado, el usuario.
    $usersIdMsj = $results[0]['users'];
    $idMessage  = $connect->prepare("SELECT COUNT(message) FROM conversation WHERE user_name = '$usersIdMsj'");
    $idMessage->execute();
    $idMsj = $idMessage->fetch();
//    var_dump($results[0]['users']);


    if(isset($results) && !empty($results) && isset($idMsj) && !empty($idMsj)){
        foreach ($idMsj as $idMsjs){}
        foreach($results as $result){}

        include_once '../Include/header.php';

        echo '
<br><br><br>
<section class="main container">
    <div class="row">
        <section class="col-md-0">
            
        </section>
        <section class="col-md-12">
            <div class="vistaUsers">';

        $fecha1 = new DateTime($result['date_registry']);
        $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
        $fecha = $fecha1->diff($fecha5);

        echo '<h1 class="text-center text-success">Perfíl</h1>';

        if($result['online'] == 1){
            echo '<center><img src="../../Views/app/Img/connect.png"></center>';
        }else{
            echo '<center><img src="../../Views/app/Img/disconnect.png"></center>';
        }

        echo '<br><center>';
        if(null == $result['foto_user']){
            echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">';
        }else{
            echo '<img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,'.base64_encode($result['foto_user']).'">';
        }
        echo '</center><br>';
        echo '<p><strong>Usuario:</strong> '.$result['users'].'</p>';
        echo '<p><strong>Registrado El</strong><br>'.$result['date_registry'].'<br>';
        echo '<br><strong>Tiempo Transcurrido:</strong>';

        if($fecha->y != 0){
            echo '<br><strong>Años <br> </strong>['.$fecha->y.']';
        }
        if($fecha->m != 0){
            echo '<br><strong>Meses <br> </strong>['.$fecha->m.']';
        }
        if($fecha->d != 0){
            echo '<br><strong>Días <br> </strong>['.$fecha->d.']';
        }
        if($fecha->h != 0){
            echo '<br><strong>Horas <br> </strong>['.$fecha->h.']';
        }
        if($fecha->i != 0){
            echo '<br><strong>Minutos <br> </strong>['.$fecha->i.']';
        }

        echo '</p>';

        echo '<p><strong>Messages Sent:</strong> '.$idMsjs[0].'</p>';
        if($result['rango'] == 0){
            echo '<p><strong>Rango:</strong> <span style="color: #169c23;font-weight: bold; font-family: Courier,Arial,Verdana;"> {Usuario}</span></p>';
        }else if($result['rango'] == 1){
            echo '<p><strong>Rango:</strong> <span style="color: #00b0ff;font-weight: bold; font-family: Courier,Arial,Verdana;"> [Moderador]</span></p>';
        }else if($result['rango'] == 2){
            echo '<p><strong>Rango:</strong> <span style="color: #ff0000;font-weight: bold; font-family: Courier,Arial,Verdana;"> ..::Administrador::..</span></p>';
        }
        echo '
            </div>
        </section>
    </div>
</section>';
        require_once '../Include/footer.php';
    }else{
        header('location: index.php');
    }
}else{
    header('location: index.php');
}