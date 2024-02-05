<?php
require_once "modulos/header.php";

require_once "../controladores/administradorcontrolador.php";
require_once "../modelos/usuariomodelo.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Enlaces a tus archivos CSS y librerías -->
</head>
<body>
   

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="">cvWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="">Administrador</a>
                    </li>

                    <li class="nav-item">

                    <!-- salir de la sesión -->
                    <!-- ... -->
                    <form action="../controladores/controlador_cerrar_sesion.php" method="post">
                        <button type="submit" class="btn btn-danger">Salir</button>
                    </form>
                    <!-- ... -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <h1 class="text-center">Usuarios Registrados</h1>
        <div class="table-responsive d-inline-block mx-auto"> <!-- Utiliza la clase mx-auto -->
            <table class="table  table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo electrónico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo que contiene la clase AdministradorControlador
                    require_once '../controladores/administradorcontrolador.php';

                    // Crear una instancia del controlador
                    $controladorUsuarios = new AdministradorControlador();

                    // Llamar a la función listarUsuarios
                    $usuarios = $controladorUsuarios->listarUsuarios();

                    // Mostrar los usuarios en la tabla
                    foreach ($usuarios as $usuario) {
                        echo "<tr>";
                        echo "<td>" . $usuario['usuario'] . "</td>";
                        echo "<td>" . $usuario['correo'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Otros elementos  -->

    <?php require_once "../vistas/modulos/footer.php"; ?>
</body>
</html>
