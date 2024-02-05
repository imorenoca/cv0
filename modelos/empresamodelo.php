<?php
require_once '../config/variablesentorno.php';
require_once '../config/conexiondb.php';
require_once '../controladores/empresacontrolador.php';

class EmpresaModelo
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

    public function obtenerEmpresas()
    {
        $ssql = "SELECT * FROM empresa ORDER BY nombre_empresa ASC;";
        return $this->ejecutarConsulta($ssql);
    }

    public function agregarEmpresa($nombre, $web)
    {
        $ssql = "INSERT INTO empresa (nombre_empresa, web) VALUES ('$nombre', '$web')";
        return $this->ejecutarConsulta($ssql);
        
    }

    public function actualizarEmpresa($id, $nombre, $web)
    {
        $ssql = "UPDATE empresa SET nombre_empresa = '$nombre', web = '$web' WHERE id_empresa = $id";
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
    

    public function eliminarEmpresa($id)
    {
        $ssql = "DELETE FROM empresa WHERE id_empresa = $id";
        return $this->ejecutarConsulta($ssql);
    }
    public function empresaEstaAsociadaAOferta($idEmpresa)
    {
        $sql = "SELECT COUNT(*) AS cantidad_ofertas FROM oferta WHERE id_empresa = ?";

        // Preparar la consulta
        $consulta = $this->mysqli->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($consulta === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Vincular parámetros y ejecutar la consulta
        $consulta->bind_param("i", $idEmpresa);
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
    public function obtenerEmpresaPorId($id)
    {
        $sql = "SELECT * FROM empresa WHERE id_empresa = ?";

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
        $empresa = $resultado->fetch_assoc();

        // Retornar los datos de la empresa o un array vacío si no se encontró ninguna empresa
        return $empresa ? $empresa : [];
    }

}
