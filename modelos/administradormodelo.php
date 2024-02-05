<?php
require_once '../config/variablesentorno.php';
require_once '../config/conexiondb.php';

class AdministradorModelo
{
    private $mysqli;

    public function __construct()
    {
        $conexionDb = new ConexionDb();
        $this->mysqli = $conexionDb->getMysqli();
    }

 
        public function obtenerUsuarios()
        {
            $conexionDb = new ConexionDB();
            $database = $conexionDb->getMysqli();
    
            $ssql = "SELECT usuario, correo FROM usuario ORDER BY usuario;";
            $result = $database->query($ssql);
    
            return $result; // Devolver directamente el resultado de la consulta
        }
    }

