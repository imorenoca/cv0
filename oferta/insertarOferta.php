<?php
session_start();
if(empty($_SESSION['id_usuario'])){
    header("location: ../vistas/login.php");
}
include_once("../config/conexiondb.php");
include_once("../config/variablesentorno.php");

$alta = $_POST['fecha_alta'];
$tipo = $_POST['tipo'];
$nombre_empresa = $_POST['nombre_empresa'];
$nombre_puesto = $_POST['nombre_puesto'];
$nombre_contacto = $_POST['nombre_contacto'];
$tecnologia = $_POST['tecnologia'];
$tipo_trabajo = $_POST['tipo_trabajo'];
$experiencia = $_POST['experiencia'];
$ingles = $_POST['ingles'];
$fecha_fin = $_POST['fecha_fin'];
$estado = $_POST['estado'];
$usuario = $_POST['id_usuario'];

// Establece el valor predeterminado para id_usuario
$id_usuario =  $_SESSION['id_usuario'];


$conexion = new ConexionDb();

// Consulta INSERT
$query = "INSERT INTO oferta (fecha_inicio, fecha_fin, nombre_puesto, experiencia_anios, ingles, tecnologia, id_envio, id_empresa, estado, tipo_trabajo, id_usuario, id_contacto) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparación de la consulta
if ($stmt = $conexion->getMysqli()->prepare($query)) {
    // Vincula los parámetros
    $stmt->bind_param("ssssssssssss", $alta, $fecha_fin, $nombre_puesto, $experiencia, $ingles, $tecnologia, $tipo, $nombre_empresa, $estado, $tipo_trabajo, $id_usuario, $nombre_contacto);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Insercción ok
        header("Location: ../vistas/ofertas.php");
    } else {
        // inserción ko
       // echo "Error al insertar los datos.";
    }

    // Cierra la declaración
    $stmt->close();
} else {
    // Manejo de error si la preparación falla
    echo "Error en la preparación de la consulta.";
}

$conexion->closeConnection();
?>
