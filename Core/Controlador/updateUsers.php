<?php

sleep(1);

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';


                                    // UPLOAD DE IMAGEN PARA LOS INMUEBLES

//print_r($_FILES);
    require_once $_SERVER['DOCUMENT_ROOT'] . '/informatic-Death/Core/library/resize.php';
    if(isset($_POST['subir']) && $_POST['subir'] == 'Subir'){

        //print_r($_FILES);
        if(isset($_FILES['file'])){
//            echo 'seguimos';

            session_start();

            $conection = new Conection();
            $modelo     = new Consultations();
            $connect = $conection->get_conection();

            $carpeta = $_SERVER['DOCUMENT_ROOT'] . '/informatic-Death/Views/app/Img/ImgUsers/';
            if(is_dir($carpeta) && is_writable($carpeta)){
                $result = count($_FILES['file']['name']);
                $endExtension = array('jpg','gif','png','jpeg');
                $msj = '';

                for($i = 0; $i < $result; $i ++){
                    $fileName = $_FILES['file']['name'][$i];
                    $fileTemp = $_FILES['file']['tmp_name'][$i];

                    $string = substr(md5(uniqid(rand())),0,12);
                    $nameNewFile = $string . '.jpg';
                    $thumbName = 'thumb_' . $nameNewFile;
                    $extencion = pathinfo($fileName,PATHINFO_EXTENSION);
                    $altName = basename($fileName, '.' . $extencion);
                    $fileInfo = pathinfo($fileName);
                    if(in_array($fileInfo['extension'],$endExtension)){
                        //
                        /**
                         * Creando thumnails, y redireccionando las imagenes originales
                         */
                        copy($fileTemp,$carpeta . $fileName);
                        $thumb = new thumbnail($carpeta . $fileName);
                        $thumb->size_width(100);
                        $thumb->size_height(100);
                        $thumb->jpeg_quality(88);
                        $thumb->save($carpeta.$thumbName);
                        //Dimension imagen original
                        $thumb = new thumbnail($carpeta . $fileName);
                        $thumb->size_width(400);
                        $thumb->size_height(300);
                        $thumb->jpeg_quality(100);
                        $thumb->save($carpeta.$nameNewFile);
                        unlink($carpeta.$nameNewFile);

                        if(!isset($_SESSION['usuario'])){
                            header('location: ../../index.php');
                        }else {
                            // Array del usuario que ingreso
                            $stm = $connect->prepare("SELECT * FROM users WHERE id_users = :uid");
                            $stm->execute(array(":uid" => $_SESSION['usuario']));
                            $user = $stm->fetch(PDO::FETCH_ASSOC);

                            $userNew        = htmlentities(addslashes($_POST['newUser']));
                            $mailNew        = htmlentities(addslashes($_POST['newMail']));
                            $passNew        = htmlentities(addslashes($_POST['newPass']));
                            $passE          = sha1($passNew);
                            $imagenBinario  = addslashes(file_get_contents($fileTemp));
                            $id_user        = htmlentities(addslashes($_POST['idu']));

                            if($user['id_users'] === $id_user){
                                if(strlen($userNew) > 0 && strlen($mailNew) > 0 && strlen($passNew) > 0 && strlen($id_user) > 0 && strlen($imagenBinario) > 0){
                                    $verifyUsres = $connect->prepare("SELECT users FROM users WHERE users = '$userNew' LIMIT 1;");
                                    $verifyUsres->execute();
                                    $count = $verifyUsres->rowCount();

                                    if($count === 0){
                                        if($user['email'] === $mailNew){
                                            $stm = $modelo->updateUsers('users',$userNew,$id_user);
                                            $stm = $modelo->updateUsers('email',$mailNew,$id_user);
                                            $stm = $modelo->updateUsers('password',$passE,$id_user);

//                                            UPDATES DE TODAS LAS TABLAS SEGUN EL USUARIO ACTUALIZADO
                                            $foto = $connect->prepare("UPDATE users set foto_user = '$imagenBinario' WHERE id_users = '$id_user'");
                                            $result = $foto->execute();
                                            $updateUsersCOnvers = $connect->prepare("UPDATE conversation set user_name = '$userNew' WHERE id_users = '$id_user'");
                                            $updateUsersCOnvers->execute();
                                            $logsUpdateUser = $connect->prepare("UPDATE logs set user = '$userNew' WHERE id_users = '$id_user'");
                                            $endLogs = $logsUpdateUser->execute();
//                                            FIN UPDATES

                                            $stm = $modelo->updateUsers('name_foto',$nameNewFile,$id_user);
                                            $stm = $modelo->updateUsers('alt_foto',$altName,$id_user);
                                            mail($mailNew,'Cambios realizados','Has solicitado cambios en tu usuario: <br>'.'Nuevo usuario: '.$userNew.'<br>'.'Nueva clave: '.$passNew);
                                            $msj = 5;
                                        }else{
                                            if($user['email'] != $mailNew){
                                                $stm = $modelo->updateUsers('email',$mailNew,$id_user);
                                                mail($mailNew,'Cambios realizados','Has solicitado cambio de tu correo: <br>'.'<strong><h4>Nuevas Credenciales<h4></strong><br>Nuevo usuario: '.$userNew.'<br>'.'Nueva clave: '.$passNew);
                                                $msj = 5;
                                            }
                                        }
                                    }else{
                                        $msj = 1;
                                    }
                                }
                            }else{
                                header('location: ../Acceso/perfil.php');
                            }
                        }

                    }else{
                        $msj = 4;
                    }

                }//Fin del bucle

                switch ($msj){
                    case 1:
                        echo 1;
                        break;
                    case 4:
                        echo '4';
                        break;
                    case 5:
                        echo '5';
                        break;
                }
                //Fin Switch

            }else{
//                echo 'La carpeta no tiene permisos';
                echo '3';
            }
        }else{
//            echo 'vacio';
            echo '2';
        }

    }else{
        header('location: ../Acceso/perfil.php');
    } // Fin de validacion