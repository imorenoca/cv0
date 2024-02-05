<?php
// UsuarioController.php
require_once '../modelos/usuariomodelo.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexionDb = new ConexionDb(); // Asegúrate de tener la clase ConexionDb disponible
    $usuarioController = new UsuarioController($conexionDb);

    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];

    $usuarioController->iniciarSesion($usuario, $contrasena);
}

class UsuarioController
{
    private $conexionDb;

    public function __construct($conexionDb)
    {
        $this->conexionDb = $conexionDb;
    }

    public function iniciarSesion($usuario, $contrasena)
    {
        // Validar datos (puedes agregar más validaciones según sea necesario)
        if (empty($usuario) || empty($contrasena)) {
            header("Location: ../vistas/login.php?error=1");
            exit();
        }

        // Lógica de inicio de sesión
        $usuarioModel = new UsuarioModelo();
        $usuarioRegistrado = $usuarioModel->verificarUsuario($usuario, $contrasena);

        if ($usuarioRegistrado) {
            session_start();
            $_SESSION["usu"] = $usuarioRegistrado['correo'];
            $_SESSION["idRol"] = $usuarioRegistrado['rol_id'];

            // Redirigir según el rol
            $this->redirigirSegunRol($usuarioRegistrado['rol_id']);
        } else {
            // La validación de inicio de sesión falló, redirige a la página de login con un mensaje de error
            header("Location: ../vistas/login.php?error=2");
            exit();
        }
    }

    private function redirigirSegunRol($rolId)
    {
        switch ($rolId) {
            case 1:
                header("Location: ../vistas/administrador.php");
                exit();
            case 2:
                header("Location: ../vistas/usuario.php");
                exit();
            default:
                header("Location: ../vistas/login.php");
                exit();
        }
    }
}
