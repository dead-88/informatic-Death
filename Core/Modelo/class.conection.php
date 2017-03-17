<?php

date_default_timezone_set('America/Bogota');

    class Conection{
        private $host   = '127.0.0.1';
        private $dbnm   = 'global_death';
        private $utf    = 'utf8';
        private $user   = 'root';
        private $pass   = '';
        private $connect= null;
        public function get_conection(){
            try{
                $this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbnm;charset=$this->utf", $this->user, $this->pass);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                return $this->connect;
            }catch (Exception $e) {
                echo "Error al conectar a la Data Base " . $e->getMessage();
            }finally{
                $this->connect = null;
            }
        }
    }

    function GetIP(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }