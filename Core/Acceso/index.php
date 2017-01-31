<?php require_once '../Include/header.php';?>
<section class="jumbotron">
    <div class="container">
        <h2 class="titulo text-capitalize">
            <?php
                if($user['foto_user'] == null){
                    echo '<img src="../../Views/app/Img/803701665_122051.jpg" alt="Error" class="thumb pull-left">';
                }else{
                    echo '<img src="data:image/*;base64,'.base64_encode($user['foto_user']).'" alt="Error" class="thumb pull-left">';
                }
                echo $user['users'];
            ?>
        </h2>
        <p class="text-left">Acercate más! <span>Te mostrare algo.</span></p>
    </div>
    <div class="clearfix"></div>
</section>

<section class="main container">
    <div class="form">
        <form action="" method="post" name="search_form" id="search_form">
            <input type="text" name="searchForm" id="searchForm" placeholder="Buscar...">
        </form>
        <div id="result"></div>
    </div>
</section>

<section class="main container">
    <div class="row">
        <section class="posts col-md-9">
            <div class="row">
                <h1 class="well text-center text-danger">Conversations...!</h1>
                <p class="flaticon-document"> Comentariós:
                    <?php
                        if(isset($MessageId)){
                            echo $MessageId[0];
                        }
                    ?></p>
                <form id="formChat" role="form" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="conversation"></div>
                            </div>
                        </div>
                    </div>
            </div>
                    <div class="hidden">
                        <input type="hidden" id="idUser" name="idUser" value="<?php if(isset($user['id_users'])){echo $user['id_users'];};?>">
                        <input type="hidden" id="userConvers" name="userConvers" value="<?php if(isset($user['users'])){echo $user['users'];}?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-center">Message:</label>
                        <textarea name="message" id="message" placeholder="Enter message..." class="form-control" role="textbox" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" id="send">
                </form>
        </section>

        <aside class="col-md-3 hidden-xs hidden-sm">
            <h4 class="text-center">Cursos gratís...</h4>
            <div class="list-group">
                <a href="#" class="list-group-item">Diseño Web</a>
                <a href="#view" class="list-group-item view">Php</a>
                <div class="obj">
                    Quieres aprender Php en pocos pasos? facil, solo tienes que darle <a href="#">ME GUSTA</a> y subscribirse en
                    nuestro canál de <a href="#">YouTube.</a>
                    <p class="text-justify">Te enseñare a crear un CRUD orientado a objetos desde cero con  MYSQL y PHP (CRUD with PDO)</p>
                </div>
                <a href="#" class="list-group-item">JavaScript</a>
                <a href="#" class="list-group-item">Css3</a>
                <a href="#" class="list-group-item">Html5</a>
                <a href="#" class="list-group-item">JQuery</a>
                <a href="#" class="list-group-item view">MySql + SQL</a>
            </div>
            <h4 class="text-center">Noticias Recientes</h4>
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">Inicia tu proyecto</h4>
                <p class="list-group-item-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consectetur eius, iusto qui soluta voluptate. Amet dolorem eaque enim labore minima nam neque quaerat reprehenderit, voluptatum? Ad autem excepturi nam.</p>
            </a>
            <h4 class="text-center">Videos</h4>
            <div class="list-group list-video">

            </div>
        </aside>
    </div>

</section>

<?php require_once '../Include/footer.php'?>