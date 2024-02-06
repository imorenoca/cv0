<?php
//         Middleware::verificarSesion();

class Middleware {
    public static function verificarSesion() {
        session_start();

        if (empty($_SESSION['id_usuario'])) {
            // Redirige a la página de inicio de sesión
            header("location: ../vistas/login.php");
            die();
        }
    }
}