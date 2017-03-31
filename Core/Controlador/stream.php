<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

    if(isset($_GET)) {
        $connection = new Conection();
        $consult    = new Consultations();
        $connect    = $connection->get_conection();

        $userOnline = (int)htmlentities(addslashes($_GET['user']));
        $timestamp  = ($_GET['timestamp'] == 0 ) ? time() : strip_tags(trim($_GET['timestamp']));
        $lastid     = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;

        $usersOn    = array();
        $pegaOnline = $connect->prepare("SELECT * FROM `users` WHERE `id_users` != '$userOnline' ORDER BY `id_users` DESC");
        $pegaOnline->execute();

        while($online = $pegaOnline->fetch()){
            $foto   = ($online['name_foto'] == '') ? 'default.jpg' : $online['name_foto'];
            $block  = explode(',', $online['block']);
            if(!in_array($userOnline, $block)){
                if($online['online'] == 0){
                    $usersOn[] = array('id' => $online['id_users'], 'user' => utf8_encode($online['users']), 'name_foto' => $foto, 'status' => 'disconnect');
                }else{
                    $usersOn[] = array('id' => $online['id_users'], 'user' => utf8_encode($online['users']), 'name_foto' => $foto, 'status' => 'connect');
                }
            }
        }

        if(empty($timestamp)){
            die(json_encode(array('status' => 'error')));
        }

        $tiempoGasto = 0;
        $lastidQuery = '';

        if(!empty($lastid)){
            $lastidQuery = ' AND `id` > '.$lastid;
        }

        if($_GET['timestamp'] == 0){
            $verify = $connect->prepare("SELECT * FROM `messages` WHERE `visto` = 0 ORDER BY `id` DESC");
        }else{
            $verify = $connect->prepare("SELECT * FROM `messages` WHERE `date_registry` >= $timestamp".$lastidQuery." AND `visto` = 0 ORDER BY `id`DESC");
        }
        $verify->execute();
        $result = $verify->rowCount();

        if($result <= 0){
            while($result <= 0){
                if($result <= 0){
                    //Dura 30 seg verificando
                    if($tiempoGasto >= 30){
                        die(json_encode(array('status' => 'vacio', 'lastid' => 0, 'timestamp' => time(), 'users' => $usersOn)));
                        exit;
                    }
                    //Descansar script por 1 seg
                    sleep(1);
                    $verify = $connect->prepare("SELECT * FROM `messages` WHERE `date_registry` >= $timestamp".$lastidQuery." AND `visto` = 0 ORDER BY `id`DESC");
                    $verify->execute();
                    $result = $verify->rowCount();
                    $tiempoGasto += 1;
                }
            }
        }
        $nuevosMsg = array();
        if($result >= 1){
            $emotions   = array(';)', ':)', ':(', '8)', ':@', ':3', ':D', '0_0', '<3', ':*', '*-*', '*_*', '(y)', ':p', '-.-', "-_-", ':!', ':|', '>.>', '>_>', '>p>', '>(>');
            $imgs       = array(
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/wink.png" width="18"/>',               //picaro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/happy.png" width="18"/>',              //feliz
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/feelingbad.png" width="18"/>',         //triste
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0041_medium.png" width="18"/>',//cool
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0054_medium.png" width="18"/>',//asombro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/sleepyembarrazed.png" width="18"/>',   //alagado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/happy2.png" width="18"/>',             //feliz2
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/O_O.png" width="18"/>',                //asombro
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0173_medium.png" width="18"/>',//corazon
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/kissheart.png" width="18"/>',          //beso
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/loveface.png" width="18"/>',           //enamorado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0076_medium.png" width="18"/>',//GatoEnamorado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0106_medium.png" width="18"/>',//Like
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/winktongue.png" width="18"/>',         //travieso
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0058_medium.png" width="18"/>',//serio
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0035_medium.png" width="18"/>',//enojado
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0053_medium.png" width="18"/>',//Mmmmmm
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0055_medium.png" width="18"/>',//Cricricri
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0037_medium.png" width="18"/>',//NoLike
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/persons-0030_medium.png" width="18"/>',//GanasDellorar
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/loltongue.png" width="18"/>',          //SacarLengüa
                '<img class="img-rounded" src="../../Views/app/Img/Emoticons/dontsee.png" width="18"/>',            //Desepcion
            );

            while($row = $verify->fetch()){
                $fotoUser = '';
                $janela_de = 0;

                if($userOnline == $row['id_de']){
                    $janela_de = $row['id_para'];

                }elseif($userOnline == $row['id_para']);{
                    $janela_de = $row['id_de'];

                    $pegaUser = $connect->prepare("SELECT `name_foto` FROM `users` WHERE `id_users` = '$row[id_de]'");
                    $pegaUser->execute();

                    while($usr = $pegaUser->fetch()){
                        $fotoUser = ($usr['name_foto'] == '') ? 'default.jpg' : $usr['name_foto'];
                    }
                }
                $msg            = str_replace($emotions, $imgs, $row['message']);
                $linkHttp       = $consult->link($msg);
                $nuevosMsg[]    = array(
                    'id'        => $row['id'],
                    'message'   => utf8_encode($linkHttp),
                    'name_foto' => $fotoUser,
                    'id_de'     => $row['id_de'],
                    'id_para'   => $row['id_para'],
                    'janela_de' => $janela_de
                );
            }
        }
        $ultimoMsg  = end($nuevosMsg);
        $ultimoId   = $ultimoMsg['id'];
        die(json_encode(array('status' => 'result', 'timestamp' => time(), 'lastid' => $ultimoId, 'datos' => $nuevosMsg, 'users' => $usersOn)));
    }