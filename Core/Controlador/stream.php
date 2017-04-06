<?php

    require_once '../Modelo/class.conection.php';
    require_once '../Modelo/class.consultations.php';

if(isset($_GET)){

    $connection = new Conection();
    $consult    = new Consultations();
    $connect    = $connection->get_conection();

    $userOnline = (int)htmlentities(addslashes($_GET['user']));
    $timestamp  = ($_GET['timestamp'] == 0) ? time() : strip_tags(trim($_GET['timestamp']));
    $lastid     = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;

    $usersOn    = array();
    $ahora      = date('Y-m-d H:i:s');
    $expira     = date('Y-m-d H:i:s', strtotime('+1 min'));
    $upOnline   = $connect->prepare("UPDATE `users` SET `limite` = ? WHERE `id_users` = ?");
    $upOnline->execute(array($expira, $userOnline));

    $pegaOnline = $connect->prepare("SELECT * FROM `users` WHERE `id_users` != '$userOnline' ORDER BY `id_users` DESC");
    $pegaOnline->execute();
    while($onlines = $pegaOnline->fetch()){

        $foto = ($onlines['name_foto'] == '') ? 'default.jpg' : $onlines['name_foto'];
        $blocks = explode(',', $onlines['block']);

        if(!in_array($userOnline, $blocks)){
            if($ahora >= $onlines['limite']){
                $usersOn[] = array('id' => $onlines['id_users'], 'user' => utf8_encode($onlines['users']), 'name_foto' => $foto, 'status' => 'disconnect');
            }else{
                $usersOn[] = array('id' => $onlines['id_users'], 'user' => utf8_encode($onlines['users']), 'name_foto' => $foto, 'status' => 'connect');
            }
        }
    }

    if(empty($timestamp)){
        die(json_encode(array('status' => 'error')));
    }

    $tempoGasto = 0;
    $lastidQuery = '';

    if(!empty($lastid)){
        $lastidQuery = ' AND `id` > '.$lastid;
    }

    if($_GET['timestamp'] == 0){
        $verifica = $connect->prepare("SELECT * FROM `messages` WHERE `visto` = 0 ORDER BY `id` DESC");
    }else{
        $verifica = $connect->prepare("SELECT * FROM `messages` WHERE `date_registry` >= $timestamp".$lastidQuery." AND `visto` = 0 ORDER BY `id`DESC");
    }
    $verifica->execute();
    $resultados = $verifica->rowCount();

    if($resultados <= 0){
        while($resultados <= 0){
            if($resultados <= 0){
                //dura 30 segundos verificando
                if($tempoGasto >= 30){
                    die(json_encode(array('status' => 'vacio', 'lastid' => 0, 'timestamp' => time(), 'users' => $usersOn)));
                    exit;
                }

                //descansar o script por um segundo
                sleep(1);
                $verifica = $connect->prepare("SELECT * FROM `messages` WHERE `date_registry` >= $timestamp".$lastidQuery." AND `visto` = 0 ORDER BY `id`DESC");
                $verifica->execute();
                $resultados = $verifica->rowCount();
                $tempoGasto += 1;
            }
        }
    }

    $newMsj = array();
    if($resultados >= 1){
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

        while($row = $verifica->fetch()){
            $fotoUser = '';
            $janela_de = 0;

            if($userOnline == $row['id_de']){
                $janela_de = $row['id_para'];

            }elseif($userOnline == $row['id_para']){
                $janela_de = $row['id_de'];
                $pegaUsr = $connect->prepare("SELECT `name_foto` FROM `users` WHERE `id_users` = '$row[id_de]'");
                $pegaUsr->execute();
                while($usr = $pegaUsr->fetch()){
                    $fotoUser = ($usr['name_foto'] == '') ? 'default.jpg' : $usr['name_foto'];
                }
            }
            $msg = str_replace($emotions, $imgs, htmlentities(addslashes($row['message'])));
            $linkHttp = $consult->link($msg);
            $newMsj[] = array(
                'id'        => $row['id'],
                'message'   => utf8_encode($linkHttp),
                'name_foto' => $fotoUser,
                'id_de'     => $row['id_de'],
                'id_para'   => $row['id_para'],
                'janela_de' => $janela_de
            );
        }
    }

    $ultimoMsg = end($newMsj);
    $ultimoId = $ultimoMsg['id'];
    die(json_encode(array('status' => 'result', 'timestamp' => time(), 'lastid' => $ultimoId, 'datos' => $newMsj, 'users' => $usersOn)));
}