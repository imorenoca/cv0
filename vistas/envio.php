<?php
require_once '../controladores/EnvioControlador.php';
require_once '../modelos/EnvioModelo.php';


// Procesamiento para agregar una nuevo envio si se envió el formulario
if (isset($_POST['agregar_envio'])) {
    $tipo = $_POST['tipo'];


    $controladorEnvio = new EnvioControlador();
    $controladorEnvio->agregarEnvio($tipo);
    echo "<script>alert('Envio agregado');</script>";
}

if (isset($_POST['eliminar_envio'])) {
    $id_envio_a_eliminar = $_POST['id_envio_a_eliminar'];

    $id_envio_a_eliminar = $_POST['id_envio_a_eliminar'];

    $modeloEnvios = new EnvioModelo();

    $envioAsociadoOferta = $modeloEnvios->ofertaAsociadoEnvio($id_envio_a_eliminar);
}

if (isset($_POST['eliminar_envio'])) {
    $id_envio_a_eliminar = $_POST['id_envio_a_eliminar'];

    $modeloEnvios = new EnvioModelo();

    $envioAsociadoOferta = $modeloEnvios->ofertaAsociadoEnvio($id_envio_a_eliminar);

    if ($envioAsociadoOferta) {
        echo "<script>alert('No se puede eliminar la envio, está asociada a una oferta.');</script>";
    } else {
        $controladorEnvio = new EnvioControlador();
        $controladorEnvio->eliminarEnvio($id_envio_a_eliminar);
        echo "<script>alert('envio eliminada');</script>";
    }
}



if (isset($_POST['actualizar_envio'])) {
    // Recoger los datos del formulario
    $id_envio = $_POST['id_envio'];
    $tipo = $_POST['tipo'];

    // var_dump($_POST);
    // Llamar al método para actualizar la envio en el controlador
    $controlador = new EnvioControlador();
    $actualizacion_exitosa = $controlador->actualizarEnvio($id_envio, $tipo);

    if ($actualizacion_exitosa) {
        // Mostrar mensaje de éxito o redirigir si es necesario
        echo "<script>alert('Datos actualizados correctamente');</script>";

    } else {
        // Manejo de error si la actualización falla
        echo "<script>alert('Error: No se pudieron actualizar los datos');</script>";
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv</title>
    <link href="../sources/bootstrap/css/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/sources/css/estilo.css">

    <script>
        function editarEnvio(idEnvio) {
            // Ocultar todos los formularios de edición
            const forms = document.querySelectorAll('[id^="form_row_"]');
            forms.forEach(form => {
                form.style.display = 'none';
            });

            // Mostrar el formulario de edición correspondiente
            const formToShow = document.getElementById('form_row_' + idEnvio);
            formToShow.style.display = 'table-row';
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">cvWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="ofertas.php">Ofertas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="empresa.php">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="">Envíos</a>
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
    <div class="container text-center">

        <h1 class="text-center">Envíos</h1>

        <div class="table-responsive d-inline-block mx-auto">
          
                <table class="table table-striped">



                    <thead>
                        <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Crear una instancia del controlador
                        $controladorEnvio = new EnvioControlador();

                        // Llamar a la función de envio
                        $envios = $controladorEnvio->mostrarEnvio();

                        // Mostrar envios en la tabla
                        
                        // Lógica para mostrar envios en la tabla
                        foreach ($envios as $envio): ?>
                            <tr>
                                <!-- Mostrar datos envio en la tabla -->
                                <td>
                                    <?= $envio['tipo'] ?>
                                </td>

                                <td>
                                    <div>
                                    <button class="btn btn-primary btn-sm"
                                            onclick="editarEnvio(<?= $envio['id_envio'] ?>)">Editar</button>
                                        <form action="" method="post" class="d-inline">
                                            <input type="hidden" name="id_envio_a_eliminar"
                                                value="<?= $envio['id_envio'] ?>">
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                name="eliminar_envio">Eliminar</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            <!-- Formulario de guardar-->
                            <tr id="form_row_<?= $envio['id_envio'] ?>" style="display: none;">
                                <td colspan="4">
                                    <form action="" method="post"
                                        class="container mx-auto d-flex justify-content-center align-items-center flex-wrap">
                                        <div class="form-group mx-2">
                                            <input type="hidden" name="id_envio" value="<?= $envio['id_envio'] ?>">
                                        </div>
                                        <div class="form-group mx-2">
                                            <input type="text" class="form-control" name="tipo"
                                                value="<?= $envio['tipo'] ?>">
                                        </div>
                                        <div class="form-group mx-2">
                                            <button class="btn btn-sm btn-secondary" type="submit" name="actualizar_envio"
                                                value="guardar">Guardar</button>
                                            <button class="btn btn-sm btn-secondary ml-2" type="button"
                                                onclick="ocultarFormulario(<?= $envio['id_envio'] ?>)">Cancelar</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>

                            <script>
                                function ocultarFormulario(idEnvio) {
                                    const formRow = document.getElementById(`form_row_${idEnvio}`);
                                    formRow.style.display = 'none';
                                }
                            </script>

                        <?php endforeach; ?>
                    </tbody>
                </table>


            </div>

            <!-- Formulario para agregar nuevo envio -->
            <div class="container mx-auto">
                <h2 class="text-center">Agregar Envío</h2>
                <br>
                <form action="" method="post" class="d-flex justify-content-center align-items-center flex-wrap">
                    <div class="form-group mx-2">
                        <input type="text" class="form-control" name="tipo" placeholder="Nombre del envio">
                    </div>
                    <div class="form-group mx-2">
                        <button class="btn btn-sm btn-success" type="submit" name="agregar_envio">Agregar envio</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <br>
    <?php require_once "../vistas/modulos/footer.php"; ?>
</body>

</html>