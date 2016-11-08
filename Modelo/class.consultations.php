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
            if(!$stm){
                echo "Error al crear registro ";
            }else{
                $stm->execute();
            }
        }

        public function insertMessage($userMessage,$message,$ip_user,$date)
        {
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "INSERT INTO conversation(user_name,message,ip_users,date_message)VALUES (:user_name,:message,:ip_users,:date_message)";
            $stm = $connect->prepare($query);
            $stm->bindParam(':user_name',$userMessage);
            $stm->bindParam(':message',$message);
            $stm->bindParam(':ip_users',$ip_user);
            $stm->bindParam(':date_message',$date);
            if(!$stm){
                echo "Error al crear registro ";
            }else{
                $stm->execute();
            }
        }

        public function insertPost($title,$article,$img,$date,$autor,$ip){
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "INSERT INTO post(title,article,img,date,autor,ip)VALUES (:title,:article,:img,:date,:autor,:ip)";
            $stm = $connect->prepare($query);
            $stm->bindParam(':img',$img);
            $stm->bindParam(':title',$title);
            $stm->bindParam(':date',$date);
            $stm->bindParam(':autor',$autor);
            $stm->bindParam(':article',$article);
            $stm->bindParam(':ip',$ip);
            $stm->execute();
        }

        public function viewPost(){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $query = "SELECT id_blog,title,article,img,date,autor,ip FROM post";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch()){
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
            $query = "SELECT id_users,users,email,ip_user,date_registry FROM users";
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
            $query = "SELECT id_conversations,user_name,message,ip_users,date_message,users,user_admin FROM conversation,users,admin where conversation.user_name = users.users OR conversation.user_name = admin.user_admin ORDER BY id_conversations";
            $stm = $connect->prepare($query);
            $stm->execute();
            while($result = $stm->fetch()){
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
                $rows[]=$result;
            }
            return $rows;
        }

        public function search($id_blog){
            $rows = null;
            $model = new Conection();
            $connect = $model->get_conection();
            $title = "%".$id_blog."%";
            $query = "SELECT id_blog,title,article,img,date,autor,ip FROM post WHERE title LIKE :title";
            $stm = $connect->prepare($query);
            $stm->bindParam(':title', $title);
            $stm->execute();
            while($result = $stm->fetch()){
                $rows[]=$result;
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
    }
