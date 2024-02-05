<?php
require_once '../config/variablesentorno.php';
require_once '../config/conexiondb.php';
require_once '../controladores/enviocontrolador.php';

class EnvioModelo
{
    private $mysqli;

    public function __construct()
    {
        $conexionDb = new ConexionDb();
        $this->mysqli = $conexionDb->getMysqli();
    }

    private function ejecutarConsulta($consulta)
    {
        return $this->mysqli->query($consulta);
    }

    public function obtenerEnvio()
    {
        $ssql = "SELECT * FROM envio order by tipo ASC";
        return $this->ejecutarConsulta($ssql);
    }

    public function agregarEnvio($tipo)
    {
        $ssql = "INSERT INTO envio (tipo) VALUES ('$tipo')";
        return $this->ejecutarConsulta($ssql);
        
    }

    public function actualizarEnvio($id, $tipo)
    {
        $ssql = "UPDATE envio SET tipo = '$tipo' WHERE id_envio = $id";
        // Agregar un mensaje de depuración
     //echo "Consulta a ejecutar: " . $ssql . "<br>";
    
        $resultado = $this->ejecutarConsulta($ssql);
    
        // Verificar si la consulta se ejecutó correctamente
       /* if ($resultado) {
            echo "<script>alert('Empresa actualizada correctamente');</script>";
        } else {
            echo "<script>alert('Error al actualizar la empresa');</script>";
        }*/
        
        return $resultado;

    }
    

    public function eliminarEnvio($id)
    {
        $ssql = "DELETE FROM envio WHERE id_envio = $id";
        return $this->ejecutarConsulta($ssql);
    }
    public function ofertaAsociadoEnvio($idEnvio)
    {
        $sql = "SELECT COUNT(*) AS cantidad_ofertas FROM oferta WHERE id_envio = ?";

        // Preparar la consulta
        $consulta = $this->mysqli->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($consulta === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Vincular parámetros y ejecutar la consulta
        $consulta->bind_param("i", $idEnvio);
        $consulta->execute();

        // Obtener el resultado
        $resultado = $consulta->get_result();

        // Verificar si se obtuvo el resultado correctamente
        if ($resultado === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Obtener el número de filas
        $fila = $resultado->fetch_assoc();
        $cantidadOfertas = $fila['cantidad_ofertas'];

        // Retornar verdadero si hay al menos una oferta asociada a la empresa
        return $cantidadOfertas > 0;
    }
    public function obtenerEnvioPorId($id)
    {
        $sql = "SELECT * FROM envio WHERE id_envio = ?";

        // Preparar la consulta
        $consulta = $this->mysqli->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($consulta === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Vincular parámetros y ejecutar la consulta
        $consulta->bind_param("i", $id);
        $consulta->execute();

        // Obtener el resultado
        $resultado = $consulta->get_result();

        // Verificar si se obtuvo el resultado correctamente
        if ($resultado === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Obtener los datos de la empresa
        $envio = $resultado->fetch_assoc();

        // Retornar los datos de la empresa o un array vacío si no se encontró ninguna empresa
        return $envio ? $envio : [];
    }

}
