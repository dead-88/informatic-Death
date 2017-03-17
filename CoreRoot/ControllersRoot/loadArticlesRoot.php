<?php

require_once '../../Core/Modelo/class.conection.php';
require_once '../../Core/Modelo/class.consultations.php';


    function viewPostAdmin(){

        $modelo = new Consultations();
        $rowspost = $modelo->viewPost();

        if(isset($rowspost)){
            foreach($rowspost as $rows){

                echo '<div class="row">
                         <section class="posts col-md-9">
                             <center><span style="cursor: pointer" class="btn btn-danger" onclick="Confirm('.$rows['id_blog'].');">Eliminar Post</span></center>
                        <article class="post clearfix">';
                echo '<h1 class="post-fecha post-h1">'.$rows['categoria'].'</h1>';
                if($rows['img'] == null){
                    echo '<a href="#Img" class="thumb pull-right">
                            <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="img-rounded">
                          </a>';
                }else{
                    echo '<a href="#Img" class="thumb pull-right">
                            <img class="img-rounded" src="data:image/*;base64,'.base64_encode($rows['img']).'" alt="ReadError">
                          </a>';
                }
                echo '<h2 class="post-title text-capitalize">'.$rows['tema'].'</h2>';
                echo '<p><span class="post-fecha">'.$rows['date'].'</span> <span class="post-title">by</span> <span class="post-autor">'.$rows['autor'].'</span></p>';
                echo '<p class="post-content text-left">'.$rows['article'].'</p>';
                echo '</article>';
                echo '</section>';
                echo '</div>';
            }
        }
    }

    function viewUsers()
    {
        if(!isset($_SESSION['root'])){
            header('location:../index.php');
        }else{
            $modelo = new Consultations();
            $users = $modelo->viewUsers();
            if(isset($users)){
                foreach($users as $user){
                    echo '<div class="row">
                         <section class="posts col-md-8">
                             <center><span style="cursor: pointer" class="btn btn-danger" onclick="ConfirmUser('.$user['id_users'].');">Eliminar Usuario</span></center>
                        <article class="post clearfix">';
                    echo '<h1 class="post-fecha post-h1">'.$user['users'].'</h1>';
                    if($user['foto_user'] == null){
                        echo '<a href="#Img" class="thumb pull-right">
                            <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="img-rounded">
                          </a>';
                    }else{
                        echo '<a href="#Img" class="thumb pull-right">
                            <img class="img-rounded" src="data:image/*;base64,'.base64_encode($user['foto_user']).'" alt="ReadError">
                          </a>';
                    }
                    echo '<h2 class="post-title text-capitalize">'.$user['email'].'</h2>';
                    echo '<p><span class="post-fecha">'.$user['date_registry'].'</span> <span class="post-autor">'.$user['users'].'</span></p>';

                    echo '</article>';
                    echo '</section>';
                    echo '<section class="col-md-4">';
                        echo '<div class="vistaUsers">';
                    $fecha1 = new DateTime($user['date_registry']);
                    $fecha5 = new DateTime(date('Y/m/d h:i:s a'));
                    $fecha = $fecha1->diff($fecha5);

                    echo '<h1 class="text-center text-success">Perfíl</h1>';
                    echo '<br><center>';
                    if($user['foto_user'] == null){
                        echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="imgPhoto">';
                    }else{
                        echo '<img style="width: 100px;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;box-shadow: 1px 5px 10px #ffffff, 3px 15px 15px #000" src="data:image/*;base64,'.base64_encode($user['foto_user']).'">';
                    }
                    echo '</center><br>';
                    echo '<p><strong>Usuario:</strong> '.$user['users'].'</p>';
                    echo '<p><strong>E-Mail:</strong> '.$user['email'].'</p>';
                    echo '<p><strong>Registrado El</strong>
                              <br>'.$user['date_registry'].'
                              <br><strong>Años  <br> </strong>[{'.$fecha->y,'}]
                              <br><strong>Meses <br> </strong>[{'.$fecha->m,'}]
                              <br><strong>Días  <br> </strong>[{'.$fecha->d,'}]
                              <br><strong>Horas <br> </strong>[{'.$fecha->h.'}]</p>';
                    echo '<p><strong>Rango:</strong> '.$user['rango'].'</p>';
                        echo '</div>';
                    echo '</section>';
                    echo '</div>';
                }
            }
        }
    }