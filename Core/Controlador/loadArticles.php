<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


function viewPost(){

    $modelo = new Consultations();
    $rowspost = $modelo->viewPost();

    if(isset($rowspost)){
        foreach($rowspost as $rows){

            echo '<div class="row">
                     <section class="posts col-md-9"> 
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
            echo '<h2 class="post-title text-capitalize">'.$rows['tema'].'</h2>
                    <p>
                        <span class="post-fecha">'.$rows['date'].'</span> 
                        <span class="post-title">by</span> 
                        <span class="post-autor">'.$rows['autor'].'</span>
                    </p>';
            echo '<p class="post-content text-left">'.$rows['article'].'</p>';
            echo '</article>';
            echo '</section>';
            echo '</div>';
        }
    }
}