<?php
session_start();
if(empty($_SESSION['id_usuario'])){
    header("location: ../vistas/login.php");
}
include_once("../config/conexiondb.php");
include_once("../config/variablesentorno.php");

if ($_POST) {
    $update = new ConexionDb();

    // Escapa los valores de $_POST para evitar inyección de SQL

    $id_oferta=$_POST["id_oferta"];
    $fecha_inicio=$_POST["fecha_inicio"];
    $fecha_fin=$_POST["fecha_fin"];
    $nombre_puesto=$_POST["nombre_puesto"];
    $experiencia=$_POST["experiencia_anios"];
    $ingles=$_POST["ingles"];
    $tecnologia=$_POST["tecnologia"]; 
    $id_envio=$_POST["id_envio"];
    $id_empresa=$_POST["id_empresa"];
    $estado=$_POST["estado"];
    $tipo_trabajo=$_POST["tipo_trabajo"] ;
    $id_usuario=$_POST["id_usuario"];
    $id_contacto=$_POST["id_contacto"];


    // Construye la consulta de actualización
    $query = "UPDATE oferta 
    SET fecha_inicio = '$fecha_inicio',
        fecha_fin = '$fecha_fin',
        nombre_puesto = '$nombre_puesto',
        experiencia_anios = '$experiencia',
        ingles = '$ingles',
        tecnologia = '$tecnologia',
        id_envio = '$id_envio',
        id_empresa = '$id_empresa',
        estado = '$estado',
        tipo_trabajo = '$tipo_trabajo',
        id_contacto = '$id_contacto'  
    WHERE id_oferta = '$id_oferta' AND id_usuario = '$id_usuario'";


    // Ejecuta la consulta
    $resultado = $update->getMysqli()->query($query);

    // Cierra la conexión a la base de datos
    $update->closeConnection();
    header("Location: ../vistas/ofertas.php");
    exit; // Asegura que el script se detenga después de la redirección


} else {
    // formulario no se envia
}
