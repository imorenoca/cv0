<?php
include_once('variablesentorno.php');
class ConexionDb {
    private $mysqli;


    public function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if ($this->mysqli->connect_errno) {
            echo "Error de conexión: " . $this->mysqli->connect_errno;
            exit;
        }
    }
    public function getMysqli() {
        return $this->mysqli;
    }

   
    public function closeConnection() {
        $this->mysqli->close();
    }
}
