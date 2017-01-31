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