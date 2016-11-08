<?php
    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    date_default_timezone_set('America/Bogota');
    $modelo = new Consultations();
    $conversations = $modelo->viewConversations();
    echo "<p class='text-center'>".date('Y/m/d  h:s:i')."</p>";
    if(isset($conversations)){
        foreach($conversations as $conversation){
            echo "<h3 class='text-capitalize'>".$conversation['user_name']."</h3>";
            echo "<span class='pull-right'>".$conversation['date_message']."</span>";
            echo "<p class='posttwoa text-left text-capitalize'>".$conversation['message']."</p>";
            echo '<span style="cursor: pointer;color: #ff0000"  onclick="Confirmmsj('.$conversation['id_conversations'].');">Eliminar Mensaje</span>';
        }
    }
