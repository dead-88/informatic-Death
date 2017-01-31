<?php

    require_once '../../Core/Modelo/class.conection.php';
    require_once '../../Core/Modelo/class.consultations.php';

    date_default_timezone_set('America/Bogota');
    $modelo = new Consultations();
    $conversations = $modelo->viewConversations();
    $conversationsAdmin = $modelo->viewConversationsAdmin();

    echo "<p class='text-center'>".date('Y/m/d  h:i:s A')."</p>";

    if (isset($conversationsAdmin)){
        foreach($conversationsAdmin as $conversationsAdmins){
            echo "<h3 class='text-capitalize'>".$conversationsAdmins['user_name']."</h3>";
            echo "<span class='pull-right'>".strtoupper($conversationsAdmins['date_message'])."</span><br>";
            echo "<p class='posttwoa text-left'>".$conversationsAdmins['message']."".' <span style="cursor: pointer;color: #ff0000"  onclick="Confirmmsj('.$conversationsAdmins['id_conversations'].');">Eliminar Mensaje</span></p>';
        }
    }

    if(isset($conversations)){
        foreach($conversations as $conversation){
            echo '<img style="width: 50px;margin-right:10px; ;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" class="pull-left" src="data:image/*;base64,'.base64_encode($conversation['foto_user']).'">';
            echo "<h3 class='text-capitalize'>".$conversation['user_name']."</h3>";
            echo "<span class='pull-right'>".strtoupper($conversation['date_message'])."</span><br>";
            echo '<p class="posttwoa text-left">'.$conversation['message'].' <span style="cursor: pointer;color: #ff0000"  onclick="Confirmmsj('.$conversation['id_conversations'].');">Eliminar Mensaje</span></p>';
        }
    }