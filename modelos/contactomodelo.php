<?php

require_once '../config/conexiondb.php';
require_once '../controladores/contactocontrolador.php';

class ContactoModelo
{
    private $mysqli;

    public function __construct()
    {
        $conexionDb = new ConexionDb();
        $this->mysqli = $conexionDb->getMysqli();
    }
    
    private function ejecutarConsulta($consulta) {
        return $this->mysqli->query($consulta);
    }
    
    public function obtenerContactos() {
        $ssql = "SELECT * FROM contacto order by nombre_contacto ASC ; ";
        return $this->ejecutarConsulta($ssql);
    }

    public function agregarContacto($nombre,$cargo, $correo,$telefono)
    {
        $ssql = "INSERT INTO contacto (nombre_contacto, cargo, correo,telefono) VALUES ('$nombre', '$cargo','$correo','$telefono')";
        return $this->ejecutarConsulta($ssql);
        
    }
    
    public function actualizarContacto($id,$nombre,$cargo, $correo,$telefono)
    {
        $ssql = "UPDATE contacto SET nombre_contacto = '$nombre', cargo = '$cargo', correo = '$correo', telefono = '$telefono' WHERE id_contacto = $id";
        // Agregar un mensaje de depuración
     //echo "Consulta a ejecutar: " . $ssql . "<br>";
    
        $resultado = $this->ejecutarConsulta($ssql);
    
        // Verificar si la consulta se ejecutó correctamente
       /* if ($resultado) {
            echo "<script>alert('Actualización correcta');</script>";
        } else {
            echo "<script>alert('Error al actualizar');</script>";
        }*/
        
        return $resultado;

    }

    public function eliminarContacto($id)
    {
        $ssql = "DELETE FROM contacto WHERE id_contacto = $id";
        return $this->ejecutarConsulta($ssql);
    }
    
    public function contactoEstaAsociadaAOferta($idcontacto)
    {
        $sql = "SELECT COUNT(*) AS cantidad_ofertas FROM oferta WHERE id_contacto = ?";

        // Preparar la consulta
        $consulta = $this->mysqli->prepare($sql);

        // Verificar si la consulta se preparó correctamente
        if ($consulta === false) {
            return false; // O manejar el error según tus necesidades
        }

        // Vincular parámetros y ejecutar la consulta
        $consulta->bind_param("i", $idcontacto);
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

        // Retornar verdadero si hay al menos una oferta asociada al contacto
        return $cantidadOfertas > 0;
    }

     
    public function obtenerContactoPorId($id) {
        $sql = "SELECT * FROM contacto WHERE id_contacto = ?";
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
                   return false; // manejar en caso necesario
               }
       
               // Obtener los datos 
               $contacto = $resultado->fetch_assoc();
       
               // Retornar los datos o array vacío.
               return $contacto ? $contacto : [];
           }
       
           

}


