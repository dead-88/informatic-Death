<?php

    class Consultations{

        public function insertUsersRegistrys($users,$pwd,$email,$ip,$date){
            $modelo = new Conection();
            $connect = $modelo->get_conection();
            $query = "INSERT INTO users(users,password,email,ip_user,date_registry)VALUES (:users,:password,:email,:ip_user,:date_registry)";
            $stm = $connect->prepare($query);
            $stm->bindParam(':users', $users);
            $stm->bindParam(':password', $pwd);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':ip_user', $ip);
            $stm->bindParam(':date_registry', $date);
            $stm->execute();
        }

        public function insertMessage($idUser,$userMessage,$message,$ip_user,$date)
        {
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "INSERT INTO conversation(id_users,user_name,message,ip_users,date_message)VALUES (:id_users,:user_name,:message,:ip_users,:date_message)";
            $stm = $connect->prepare($query);
            $stm->bindParam(':id_users',$idUser);
            $stm->bindParam(':user_name',$userMessage);
            $stm->bindParam(':message',$message);
            $stm->bindParam(':ip_users',$ip_user);
            $stm->bindParam(':date_message',$date);
            $stm->execute();

        }

        public function insertPost($categoria,$tema,$article,$img,$alt,$nameIMg,$date,$autor,$ip){
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "INSERT INTO post(categoria,tema,article,img,alt,nameImg,date,autor,ip)VALUES (:categoria,:tema,:article,:img,:alt,:nameImg,:date,:autor,:ip)";
            $stm = $connect->prepare($query);
            $stm->bindParam(':categoria',$categoria);
            $stm->bindParam(':tema',$tema);
            $stm->bindParam(':article',$article);
            $stm->bindParam(':img',$img);
            $stm->bindParam(':alt',$alt);
            $stm->bindParam(':nameImg',$nameIMg);
            $stm->bindParam(':date',$date);
            $stm->bindParam(':autor',$autor);
            $stm->bindParam(':ip',$ip);
            $stm->execute();
        }

        public function viewPost(){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "SELECT * FROM post";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch(PDO::FETCH_ASSOC)){
                $rows[]=$result;
            }
            return $rows;
        }

        public function viewAdmin(){
            $rows = null;
            $modelo = new Conection();
            $connect = $modelo->get_conection();
            $query = "SELECT id_admin,user_admin,email,ip,date FROM admin";
            $stm = $connect->prepare($query);
            $stm->execute();
            while ($result = $stm->fetch()){
                $rows[] = $result;
            }
            return $rows;
        }

        public function viewUsers(){
            $rows = null;
            $modelo = new Conection();
            $connect = $modelo->get_conection();
            $query = "SELECT id_users,users,email,ip_user,date_registry,foto_user FROM users";
            $stm = $connect->prepare($query);
            $stm->execute();
            while ($result = $stm->fetch()){
                $rows[] = $result;
            }
            return $rows;
        }

        public function viewConversations(){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "SELECT conversation.id_conversations,conversation.date_message,conversation.user_name,conversation.message,users.users,users.foto_user FROM conversation,users WHERE conversation.user_name = users.users ORDER BY conversation.id_conversations";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch(PDO::FETCH_ASSOC)){
                $rows[]=$result;
            }
            return $rows;
        }

        public function viewConversationsAdmin(){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "SELECT conversation.id_conversations,conversation.date_message,conversation.user_name,admin.user_admin,conversation.message FROM conversation,admin WHERE conversation.user_name = admin.user_admin ORDER BY conversation.id_conversations";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch(PDO::FETCH_ASSOC)){
                $rows[]=$result;
            }
            return $rows;
        }

        public function viewConversationsId(){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "SELECT COUNT(id_conversations) FROM conversation";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch()){
                $rows[] = $result;
            }
            return $rows;
        }

        public function delete($id){
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "DELETE FROM post WHERE id_blog = :id_blog";
            $stm = $connect->prepare($query);
            $stm->bindParam(':id_blog',$id);
            $stm->execute();
        }

        public function deletemsj($id){
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "DELETE FROM conversation WHERE id_conversations = :id_conversations";
            $stm = $connect->prepare($query);
            $stm->bindParam(':id_conversations',$id);
            $stm->execute();
        }

        public function updateUsers($campo,$valor,$id_user){
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "UPDATE users SET $campo = :valor WHERE id_users = :id_users";
            $stm = $connect->prepare($query);
            $stm->bindParam(':valor',$valor);
            $stm->bindParam(':id_users',$id_user);
            $stm->execute();
        }

        public function link($msj){
            $msj = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i','<a href="\0">\0</a>',$msj);
        }
    }
