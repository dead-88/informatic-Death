<?php
    class Conection extends mysqli
    {

        public function get_conection()
        {
            try {
                $db = new PDO("mysql:host=127.0.0.1;dbname=global_death;charset=utf8", "root", "");
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                return $db;
            } catch (Exception $e) {
                echo "Error al conectar a la Data Base " . $e->getMessage();
            }
        }
    }

