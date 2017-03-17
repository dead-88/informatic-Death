<?php

sleep(1);

require_once '../Modelo/class.conection.php';
require_once '../Modelo/class.consultations.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/informatic-Death/Core/library/resize.php';

                                    // UPLOAD DE IMAGEN PARA USERS
    session_start();
    $conection  = new Conection();
    $consult    = new Consultations();
    $connect    = $conection->get_conection();

    // Registro completo del usuario que ingreso.
    $stm  = $connect->prepare("SELECT * FROM users WHERE id_users = :uid");
    $stm->execute(array(":uid" => $_SESSION['usuario']));
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    // Fin del usuario que ingreso.

    $userNew        = htmlentities(addslashes($_POST['newUser']));
    $passNew        = htmlentities(addslashes($_POST['newPass']));
    $passVerify     = htmlentities(addslashes($_POST['newPassTwo']));
    $passE          = $consult->Encrypt($passNew);
    $id_user        = htmlentities(addslashes($_POST['idu']));
    $date_update    = date('Y/m/d h:i:s a');

    $query  = "SELECT users FROM users WHERE users = :users";
    $stmTwo = $connect->prepare($query);
    $stmTwo->bindParam(':users',$userNew);
    $stmTwo->execute();
    $count  = $stmTwo->rowCount();

    $mailUser = $user['email'];

//print_r($_FILES);
    if(isset($_POST['subir']) && $_POST['subir'] == 'Subir'){
        //print_r($_FILES);
        if(isset($_FILES['file'])){
//            echo 'seguimos';
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

                    if(!isset($_SESSION['usuario'])){
                        header('location: ../../index.php');
                    }else {
                        $imagenBinario  = addslashes(file_get_contents($fileTemp));
                        if($user['id_users'] === $id_user){// Si el id del usuario es el mismo que se recoje en el formulario pasamos el primer bloque de seguridad
                            if(strlen($userNew) > 0 && strlen($passNew) > 0 && strlen($id_user) > 0 && strlen($imagenBinario) > 0){//Si los campos del formulario no estan vacios pasamos el segundo bloque de seguridad
                                if($count == 0 || $user['users'] == $userNew){// Si el usuario es diferente a los que existen en la DB pasamos tercer bloque de seguridad
                                    if($passNew === $passVerify){// Si las contraseñas son iguales parar el cuarto bloque de seguridad
                                        if(in_array($fileInfo['extension'],$endExtension)) {// Si la extencion de la img son JPG, GIF & PNG pasar quinto bloque de seguridad
                                            //
                                            /**
                                             * Creando thumnails, y redireccionando las imagenes originales
                                             **/
                                            copy($fileTemp, $carpeta . $fileName);
                                            $thumb = new thumbnail($carpeta . $fileName);
                                            $thumb->size_width(400);
                                            $thumb->size_height(300);
                                            $thumb->jpeg_quality(200);
                                            $thumb->save($carpeta . $thumbName);
                                            //Dimension imagen original
                                            $thumb = new thumbnail($carpeta . $fileName);
                                            $thumb->size_width(400);
                                            $thumb->size_height(300);
                                            $thumb->jpeg_quality(100);
                                            $thumb->save($carpeta . $nameNewFile);
                                            unlink($carpeta . $nameNewFile);

                                            $stm = $consult->updateUsers('users',$userNew,$id_user);
                                            $stm = $consult->updateUsers('password',$passE,$id_user);
                                            $stm = $consult->updateUsers('date_update',$date_update,$id_user);
                                            $stm = $consult->updateUsers('name_foto',$nameNewFile,$id_user);
                                            $stm = $consult->updateUsers('alt_foto',$altName,$id_user);
                                            // UPDATES DE TODAS LAS TABLAS SEGUN EL USUARIO ACTUALIZADO
                                            $foto = $connect->prepare("UPDATE users set foto_user = '$imagenBinario' WHERE id_users = '$id_user'");
                                            $foto->execute();
                                            $stmTree = $connect->prepare("UPDATE conversation set user_name = '$userNew' WHERE id_users = '$id_user'");
                                            $stmTree->execute();
                                            $stmFort = $connect->prepare("UPDATE logs set user = '$userNew' WHERE id_users = '$id_user'");
                                            $stmFort->execute();
                                            // FIN UPDATES

                                            // Envio de email
                                            $to     = 'informatic.death@gmail.com';
                                            $from   = $mailUser;
                                            $subj   = 'Cambios realizados';
                                            $body   = 'Has solicitado cambios en tu cuenta: <br>'.'Nuevo usuario: '.$userNew.'<br>'.'Nueva clave: '.$passNew;

                                            $header = getHeaders($from);
                                            $result = mail($to, $subj,$body,$header);
                                            if($result){
                                                echo '7';
                                                echo '5';
                                            }else{
                                                echo '8';
                                            }

                                            function getHeaders($from_addres){
                                                return "From: $from_addres\rReply-To: $from_addres\rReturn-path:$from_addres";
                                            }
                                            //Fin envio
                                        }else{
                                            echo '4';
                                        }
                                    }else{
                                        echo '6';
                                    }
                                }else{
                                    echo '1';
                                }
                            }
                        }else{
                            header('location: ../Acceso/perfil.php');
                        }
                    }

                }//Fin del bucle
            }else{
//                echo 'La carpeta no tiene permisos';
                echo '3';
            }
        }else{
            if(!isset($_FILES['file'])){
                if($user['id_users'] === $id_user){
                    if(strlen($userNew) > 0 && strlen($passNew) > 0 && strlen($id_user) > 0){
                        if($count == 0 || $user['users'] == $userNew){
                            if($passNew === $passVerify){
                                $stm = $consult->updateUsers('users',$userNew,$id_user);
                                $stm = $consult->updateUsers('password',$passE,$id_user);
                                $stm = $consult->updateUsers('date_update',$date_update,$id_user);
                                // UPDATES DE TODAS LAS TABLAS SEGUN EL USUARIO ACTUALIZADO
                                $stmTree = $connect->prepare("UPDATE conversation set user_name = '$userNew' WHERE id_users = '$id_user'");
                                $stmTree->execute();
                                $stmFort = $connect->prepare("UPDATE logs set user = '$userNew' WHERE id_users = '$id_user'");
                                $stmFort->execute();
                                // FIN UPDATES

                                // Envio de email
                                function getHeaders($from_addres){
                                    return "From: $from_addres\rReply-To: $from_addres\rReturn-path:$from_addres";
                                }

                                $to     = 'informatic.death@gmail.com';
                                $from   = $mailUser;
                                $subj   = 'Cambios realizados';
                                $body   = 'Has solicitado cambios en tu cuenta: <br>'.'Nuevo usuario: '.$userNew.'<br>'.'Nueva clave: '.$passNew;

                                $header = getHeaders($from);
                                $result = mail($to, $subj,$body,$header);
                                if($result){
                                    echo '7';
                                    echo '5';
                                }else{
                                    echo '8';
                                }
                                //Fin envio
                            }else{
                                echo '6';
                            }
                        }else{
                            echo '1';
                        }
                    }
                }else{
                    header('location: ../Acceso/perfil.php');
                }
            }
        }
    }else{
        header('location: ../Acceso/perfil.php');
    } // Fin de validacion