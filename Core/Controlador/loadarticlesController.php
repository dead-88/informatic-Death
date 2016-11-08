<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


function viewPost()
{

    $modelo = new Consultations();
    $rowspost = $modelo->viewPost();
    if(isset($rowspost)){
        foreach($rowspost as $rows){

            echo '<div class="row">
                          <section class="posts col-md-9"> 
                <article class="post clearfix">
                <a href="../Img/'.$rows['img'].'" target="_blank" class="thumb pull-right">
                        <img class="img-rounded" src="../Img/'.$rows['img'].'" alt="ReadError">
                    </a>
               <h2 class="post-title">'.$rows['title'].'</h2>
                <p><span class="post-fecha">'.$rows['date'].'</span> By <span class="post-autor">'.$rows['autor'].'</span></p>
                <p class="post-content text-left">'.$rows['article'].'</p>';
            echo '</article>';
            echo '</section>';
            echo '</div>';
        }
    }
}

function search($title){

    $modelo = new Consultations();
    $rowspost = $modelo->search($title);

    if(isset($rowspost)){
        foreach($rowspost as $rows){

            echo '<div class="row">
                          <section class="posts col-md-9"> 
                <article class="post clearfix">
                <a href="../Img/'.$rows['img'].'" target="_blank" class="thumb pull-right">
                        <img class="img-rounded" src="../Img/'.$rows['img'].'" alt="ReadError">
                    </a>
               <h2 class="post-title">'.$rows['title'].'</h2>
                <p><span class="post-fecha">'.$rows['date'].'</span> By <span class="post-autor">'.$rows['autor'].'</span></p>
                <p class="post-content text-left">'.$rows['article'].'</p>';
            echo '</article>';
            echo '</section>';
            echo '</div>';
        }
    }
}