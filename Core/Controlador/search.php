<?php

    require_once '../Modelo/class.conection.php';

    sleep(1);

    $modelo = new Conection();
    $connect = $modelo->get_conection();

    $search = '';
    if(isset($_POST['searchForm'])){
        $search = htmlentities(addslashes($_POST['searchForm']));
    }

    $tema   = "%".$search."%";
    $query  = "SELECT * FROM post,categorias WHERE (tema LIKE :tema OR nombre LIKE :nombre) AND id_categoria = id ORDER BY id_blog";
    $stm    = $connect->prepare($query);
    $stm->bindParam(':tema', $tema);
    $stm->bindParam(':nombre', $tema);
    $stm->execute();
    $count  = $stm->rowCount();
    $row    = $stm->fetch(PDO::FETCH_ASSOC);


    if($count > 0 && $search != ''){
        echo '<h2><center>Resultado de la búsqueda.</center></h2>';
        do {
            echo '<div class="row">
                     <section class="posts col-md-9"> 
                        <article class="post clearfix">';
            echo '
                        <h1 style="text-transform: capitalize; padding-left: 10px; border-left: #ff0000 3px solid;background-color: #0f0f0f;" class="post-fecha">'.$row['nombre'].'</h1>';

            if($row['img'] == null){
                echo '<a href="#Img" class="thumb pull-right">
                            <img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="img-rounded">
                          </a>';
            }else{
                echo '<a href="#Img" class="thumb pull-right">
                            <img class="img-rounded" src="data:image/*;base64,'.base64_encode($row['img']).'" alt="ReadError">
                          </a>';
            }
            echo '<h2 class="post-title text-capitalize">'.$row['tema'].'</h2>';
            echo'<p><span class="post-fecha">'.$row['date'].'</span> <span class="post-title">by</span> <span class="post-autor">'.$row['autor'].'</span></p>';
            echo '<p class="post-content text-left">'.$row['article'].'</p>';
            echo '</article>';
            echo '</section>';
            echo '</div>';
        }while($row = $stm->fetch(PDO::FETCH_ASSOC));
    }elseif ($count >= 0 && $search == '') echo '<h2 class="text-capitalize text-danger"><center>Que estas búscando?</center></h2>';
    else echo '<center>No se encontro la búsqueda</center>';