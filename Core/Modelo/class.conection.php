<?php
    class Conection
    {

        public function get_conection()
        {
            try {
                $db = new PDO("mysql:host=127.0.0.1;dbname=global_death;charset=utf8", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                return $db;
            } catch (Exception $e) {
                return "Error al conectar a la Data Base " . $e->getMessage();
            }
        }
    }


date_default_timezone_set('America/Bogota');

#Constantes de conexión
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','global_death');


#Constantes de la APP
define('APP_TITLE','WeAreOne');
define('APP_URL','http://127.0.0.1/dead/'); //Adaptado a mi nuevo entorno con Ubuntu

#Constantes de PHPMailer
define('PHPMAILER_HOST','p3plcpnl0173.prod.phx3.secureserver.net');
define('PHPMAILER_USER','public@ocrend.com');
define('PHPMAILER_PASS','Prinick2016');
define('PHPMAILER_PORT',465);

#Estructure

require('../Controlador/EmailTemplates.php');
