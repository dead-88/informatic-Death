<?php

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


    function viewPostAdmin()
    {
        if(!isset($_SESSION['root'])){
            header('location:../index.php');
        }else{
            $modelo = new Consultations();
            $conversations = $modelo->viewUsers();
            if(isset($conversations)){
                foreach($conversations as $conversation){}
            }
        }

        $modelo = new Consultations();
        $rowspost = $modelo->viewPost();

        if(isset($rowspost)){
            foreach($rowspost as $rows){

                echo '<section class="main container">
                       <div class="row">
                          <section class="posts col-md-9"> 
                            <span style="cursor: pointer" class="btn btn-danger" onclick="Confirm('.$rows['id_blog'].');">Eliminar Post</span>
                <article class="post clearfix">
                <a href="../Views/app/Img/'.$rows['img'].'" target="_blank" class="thumb pull-right">
                        <img class="img-rounded" src="../Views/app/Img/'.$rows['img'].'" alt="ReadError">
                    </a>
               <h2 class="post-title">'.$rows['title'].'</h2>
                <p>'.$rows['date'].'<span class="post-fecha"></span> by <span class="post-autor text-capitalize"><a href="#">'.$rows['autor'].'</a></span></p>
                <p class="post-content text-left">'.$rows['article'].'</p>';
                echo '</article>';
                echo '</section>';
                echo '</div>';
                echo '</section>';
            }
        }
    }

    function search($title){
        if(!isset($_SESSION['root'])){
            header('location:../index.php');
        }else{
            $modelo = new Consultations();
            $conversations = $modelo->viewUsers();
            if(isset($conversations)){
                foreach($conversations as $conversation){}
            }
        }

        $modelo = new Consultations();
        $rowspost = $modelo->search($title);

        if(isset($rowspost)){
            foreach($rowspost as $rows){

                echo '<section class="main container">
                       <div class="row">
                          <section class="posts col-md-9"> 
                            <span style="cursor: pointer" class="btn btn-danger" onclick="Confirm('.$rows['id_blog'].');">Eliminar Post</span>
                <article class="post clearfix">
                <a href="../Views/app/Img/'.$rows['img'].'" target="_blank" class="thumb pull-right">
                        <img class="img-rounded" src="../Views/app/Img/'.$rows['img'].'" alt="ReadError">
                    </a>
               <h2 class="post-title">'.$rows['title'].'</h2>
                <p>'.$rows['date'].'<span class="post-fecha"></span> by <span class="post-autor"><a href="#">'.$rows['autor'].'</a></span></p>
                <p class="post-content text-left">'.$rows['article'].'</p>';
                echo '</article>';
                echo '</section>';
                echo '</div>';
                echo '</section>';
            }
        }
    }