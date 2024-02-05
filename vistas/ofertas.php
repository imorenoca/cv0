<?php
session_start();
if (empty($_SESSION['id_usuario'])) {
    header("location: login.php");
}

$id_usuario = $_SESSION['id_usuario'];

include_once('../config/variablesentorno.php');
include_once('../config/conexiondb.php');

//el boton agregar envia a AgregarForm.php y este a insertarOferta.php y vuelve al índice.
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv</title>
    <link href="/sources/bootstrap/css/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./sources/css/estilo.css">
</head>
<div class="container">
    <header>
        <!--<?php include_once('vistas/head.php'); ?>-->
    </header>
</div>

<body>
<nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="/cv/index.php">cvWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="">Ofertas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="empresa.php">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="envio.php">Envíos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.php">Contactos</a>
                    </li>
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
    <br>

    <div class="container">
        <h1 class="text-center">Listado de ofertas</h1>


        <div class="container d-flex justify-content-end">
            <form action="" method="GET">
                <label for="filtro">Filtrar por estado:</label>
                <select name="filtro" id="filtro">
                    <option value="">Mostrar todas</option>
                    <option value="abierto">Abiertas</option>
                    <option value="cerrado">Cerradas</option>
                    <option value="guardado">Guardadas</option>
                </select>
                <button type="submit" class="btn btn-secondary btn-sm" name="btnfiltro">Filtrar</button>
            </form>
        </div>


        <div class="container table-responsive mx-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Fecha Alta</th>
                        <th scope="col">Envio</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Tecnología</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Años</th>
                        <th scope="col">Inglés</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

                    $database = new ConexionDb();
                    $ssql = "SELECT 
           oferta.*, 
           empresa.*, 
           contacto.*, 
           envio.*, 
           usuario.*
        FROM oferta
        INNER JOIN empresa ON oferta.id_empresa = empresa.id_empresa
        LEFT JOIN contacto ON oferta.id_contacto = contacto.id_contacto
        INNER JOIN envio ON oferta.id_envio = envio.id_envio
        INNER JOIN usuario ON oferta.id_usuario = usuario.id_usuario 
        WHERE usuario.id_usuario = $id_usuario";

                    // Filtrar por estado si se ha seleccionado 
                    if ($filtro && $filtro !== 'todos') {
                        $ssql .= " AND oferta.estado = '$filtro'";
                    }

                    $ssql .= " ORDER BY fecha_inicio ASC";

                    $result = $database->getMysqli()->query($ssql);
                    while ($oferta = $result->fetch_assoc()) {
                        // Aquí se muestra cada resultado
                    

                        ?>

                        <tr>

                            <td scope="row">
                                <?php
                                $fecha = new DateTime($oferta['fecha_inicio']);
                                echo $fecha->format("d/m/Y");
                                ?>
                            </td>

                            <td scope="row">
                                <?php echo $oferta['tipo'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['nombre_empresa'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['nombre_puesto'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['nombre_contacto'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['tecnologia'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['tipo_trabajo'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['experiencia_anios'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['ingles'] ?>
                            </td>
                            <td scope="row">
                                <?php echo $oferta['fecha_fin'] ?>

                            </td>
                            <td scope="row">
                                <?php echo $oferta['estado'] ?>
                            </td>

                            <td>
                                <button type="button" class="btn btn-light btn-icon">
                                    <a href="../oferta/editarOferta.php?id_oferta=<?php echo $oferta['id_oferta'] ?>">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-vector-pen" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.400A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z"></path>
                                        </svg>
                                    </a>
                                </button>
                                <button type="button" class="btn btn-light btn-icon">
                                    <a
                                        href="../oferta/eliminarOferta.php?id_oferta=<?php echo $oferta['id_oferta'] ?>">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z">
                                            </path>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z">
                                            </path>
                                        </svg>
                                    </a>
                                </button>
                            </td>


                        </tr>
                        <?php
                    }
                    ?>
                <tbody>
            </table>

        </div>


        <br>
        <div class="container">
            <a href="../oferta/AgregarForm.php" class="btn btn-success">Agregar Oferta</a>
        </div>
</body>


     <?php include_once("../vistas/modulos/footer.php"); ?>


</html>