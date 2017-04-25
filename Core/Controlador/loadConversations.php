<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';
    date_default_timezone_set('America/Bogota');
    session_start();

    $modelo             = new Consultations();
    $conection          = new Conection();
    $connect            = $conection->get_conection();
    $conversations      = $modelo->viewConversations();
    $session            = $modelo->session();
    $MessageId          = count($conversations);

    echo '<p class="flaticon-document" style="color: #000;"> Comentariós: [';
    if(isset($MessageId)){
        echo $MessageId;
    }
    echo ']</p>';

    echo "<p style='color: #000;' class='text-center'>".date('Y/F/l-d h:i:s A')."</p>";

    if(isset($conversations)){
        foreach($conversations as $conversation){
            $targets = $modelo->link($conversation['message']);
            $ahora   = date('Y-m-d H:i:s');
            // Si el usuario que escribio es el mismo que ingreso, se vera la vista en la parte derecha
            if(isset($_SESSION['id_user'], $conversation['id_users']) && $conversation['id_users'] == $_SESSION['id_user']){
                if($conversation['foto_user'] == null){
                    echo '<img style="width: 50px;margin-left:10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="../../Views/app/Img/user.png" alt="Error" class="thumb pull-right">';

                    if($ahora <= $conversation['limite']){
                        echo '<img class="pull-right" src="../../Views/app/Img/disconnect.png">';
                    }else{
                        echo '<img class="pull-right" src="../../Views/app/Img/connect.png">';
                    }

                }else{
                    echo '<img style="width: 50px;margin-left:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" class="pull-right" src="data:image/*;base64,'.base64_encode($conversation['foto_user']).'">';

                    if($ahora <= $conversation['limite']){
                        echo '<img class="pull-right" src="../../Views/app/Img/disconnect.png">';
                    }else{
                        echo '<img class="pull-right" src="../../Views/app/Img/connect.png">';
                    }

                }

                echo "<h3 class='text-right'>
                        <a style='color: #000' target='_blank' href='../Acceso/Usuarios.php?id_users=".$conversation['id_users']."'>
                            ".$conversation['user_name']."
                        </a>
                      </h3>";
                echo "<span style='font-size: 12px;color: #000;' class='pull-right'>".strtoupper($conversation['date_message'])."</span><br>";

                echo '<p class="postRight">'.nl2br($targets);
                if($session[0]['rango'] >= 2){
                    echo '<br><span style="cursor: pointer;color: #ff0000"  onclick="Confirmmsj('.$conversation['id_conversations'].');">Eliminar Mensaje</span>';
                }
                echo '</p>';

            }else{//Si No se vera la vista en la parte izquierda
                if($conversation['foto_user'] == null){// si el usuario no tiene foto se vera una cargada por el serviror
                    echo '<img style="width: 50px;margin-right:10px; -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" src="../../Views/app/Img/user.png" alt="Error" class="thumb pull-left">';

                    if($ahora <= $conversation['limite']){
                        echo '<img class="pull-left" src="../../Views/app/Img/disconnect.png">';
                    }else{
                        echo '<img class="pull-left" src="../../Views/app/Img/connect.png">';
                    }

                }else{// si tiene foto, se carga en la pagina web
                    echo '<img style="width: 50px;margin-right:10px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;" class="pull-left" src="data:image/*;base64,'.base64_encode($conversation['foto_user']).'">';

                    if($ahora <= $conversation['limite']){
                        echo '<img class="pull-left" src="../../Views/app/Img/disconnect.png">';
                    }else{
                        echo '<img class="pull-left" src="../../Views/app/Img/connect.png">';
                    }

                }

                echo "<h3 class='text-left'>
                        <a style='color: #ffffff' target='_blank' href='../Acceso/Usuarios.php?id_users=".$conversation['id_users']."'>
                            ".$conversation['user_name']."
                        </a>
                      </h3>";
                echo "<span style='font-size: 12px;' class='pull-left'>".strtoupper($conversation['date_message'])."</span><br>";

                echo '<p class="posttwoa">'.nl2br($targets);
                if($session[0]['rango'] >= 2){
                    echo '<span style="cursor: pointer;color: #ff0000"  onclick="Confirmmsj('.$conversation['id_conversations'].');">Eliminar Mensaje</span>';
                }
                echo '</p>';
            }
        }
    }