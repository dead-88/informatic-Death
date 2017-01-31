<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';

    date_default_timezone_set('America/Bogota');
    $modelo = new Consultations();
    $conection = new Conection();
    $connect = $conection->get_conection();
    $conversations = $modelo->viewConversations();
    $conversationsAdmin = $modelo->viewConversationsAdmin();

    session_start();
    // Array del usuario que ingreso
    $stm = $connect->prepare("SELECT * FROM users WHERE id_users = :uid");
    $stm->execute(array(":uid" => $_SESSION['usuario']));
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    echo "<p class='text-center'>".date('Y/m/d  h:i:s A')."</p>";

    if (isset($conversationsAdmin)){
        foreach($conversationsAdmin as $conversationsAdmins){
            echo "<h3 class='text-capitalize'>".$conversationsAdmins['user_name']."</h3>";
            echo "<span class='pull-right'>".strtoupper($conversationsAdmins['date_message'])."</span><br>";
            echo "<p class='posttwoa text-left'>".$conversationsAdmins['message']."</p>";
        }
    }

    if(isset($conversations)){
        foreach($conversations as $conversation){
            if($conversation['user_name'] == $user['users']){
                if($conversation['foto_user'] == null){
                    echo '<img style="width: 50px;margin-left:10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="thumb pull-right">';
                }else{
                    echo '<img style="width: 50px;margin-left:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" class="pull-right" src="data:image/*;base64,'.base64_encode($conversation['foto_user']).'">';
                }

                echo "<h3 class='text-right text-capitalize'>".$conversation['user_name']."</h3>";
                echo "<span class='pull-right'>".strtoupper($conversation['date_message'])."</span><br>";
                echo "<p class='postRight text-right'>".$conversation['message']."</p>";
            }else{
                if($conversation['foto_user'] == null){
                    echo '<img style="width: 50px;margin-right:10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="thumb pull-left">';
                }else{
                    echo '<img style="width: 50px;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" class="pull-left" src="data:image/*;base64,'.base64_encode($conversation['foto_user']).'">';
                }

                echo "<h3 class='text-left text-capitalize'>".$conversation['user_name']."</h3>";
                echo "<span class='pull-left'>".strtoupper($conversation['date_message'])."</span><br>";
                echo "<p class='posttwoa text-left'>".$conversation['message']."</p>";
            }
            }
    }
