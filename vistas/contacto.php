<?php
require_once '../controladores/contactocontrolador.php';
require_once '../modelos/contactomodelo.php';
require_once ('../middlewares/Middleware.php');
Middleware::verificarSesion();

// Procesamiento para agregar el nuevo contacto
if (isset($_POST['agregar_contacto'])) {
    $nombre_contacto = $_POST['nombre_contacto'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];


    $controladorContactos = new ContactoControlador();
    $controladorContactos->agregarContacto($nombre_contacto, $cargo, $correo, $telefono);   
    echo "<script>alert('Contacto agregado');</script>";
}


if (isset($_POST['eliminar_contacto'])) {
    $id_contacto_a_eliminar = $_POST['id_contacto_a_eliminar'];

    $modeloContactos = new ContactoModelo();

    $contactoAsociadaOferta = $modeloContactos->contactoEstaAsociadaAOferta($id_contacto_a_eliminar);

    if ($contactoAsociadaOferta) {
        echo "<script>alert('No se puede eliminar el contacto, está asociado a una oferta.');</script>";
    } else {
        $controladorContactos = new ContactoControlador();
        $controladorContactos->eliminarContacto($id_contacto_a_eliminar);
        echo "<script>alert('Contacto eliminado');</script>";
    }
}



if (isset($_POST['actualizar_contacto'])) {
    // Recoger los datos del formulario
    $id = $_POST['id_contacto'];
    $nombre_contacto = $_POST['nombre_contacto'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    // var_dump($_POST);
    // Llamar al método para actualizar contacto en el controlador
    $controlador = new ContactoControlador();
    $actualizacion_exitosa = $controlador->actualizarContacto($id,$nombre_contacto,$cargo,$correo,$telefono);

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
    <title>contactos</title>
    <link href="../sources/bootstrap/css/bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/sources/css/estilo.css">
    <script>
        function editarContacto(idContacto) {
            // Ocultar todos los formularios de edición
            const forms = document.querySelectorAll('[id^="form_row_"]');
            forms.forEach(form => {
                form.style.display = 'none';
            });

            // Mostrar el formulario de edición correspondiente
            const formToShow = document.getElementById('form_row_' + idContacto);
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
                        <a class="nav-link" href="envio.php">Envíos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-primary" aria-current="page" href="">Contactos</a>
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
    <div class="container table-responsive mx-auto">
        <h1 class="text-center">Contactos</h1>

        <table class="table table-striped">
            <thead>
                <tr>

                    <th scope="col">Nombre Contacto</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    // Crear una instancia del controlador
                    $controladorContactos = new ContactoControlador();

                    // Llamar a la función 
                    $contactos = $controladorContactos->mostrarContactos();

                               
                    // Lógica para mostrar en la tabla
                    foreach ($contactos as $contacto): ?>
                        <tr>
                            <!-- Mostrar datos en la tabla -->
                            <td>
                                <?= $contacto['nombre_contacto'] ?>
                            </td>
                            <td>
                                <?= $contacto['cargo'] ?>
                            </td>
                            <td>
                                <?= $contacto['correo'] ?>
                            </td>
                            <td>
                                <?= $contacto['telefono'] ?>
                            </td>
                            <td>
                                <div>
                                <button class="btn btn-primary btn-sm"
                                        onclick="editarContacto(<?= $contacto['id_contacto'] ?>)">Editar</button>
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="id_contacto_a_eliminar"
                                            value="<?= $contacto['id_contacto'] ?>">
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            name="eliminar_contacto">Eliminar</button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                        <!-- Formulario de guardar-->
                        <tr id="form_row_<?= $contacto['id_contacto'] ?>" style="display: none;">
                            <td colspan="4">
                                <form action="" method="post"
                                    class="container mx-auto d-flex justify-content-center align-items-center flex-wrap">
                                    <div class="form-group mx-2">
                                        <input type="hidden" name="id_contacto" value="<?= $contacto['id_contacto'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="nombre_contacto"
                                            value="<?= $contacto['nombre_contacto'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="cargo" value="<?= $contacto['cargo'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="correo" value="<?= $contacto['correo'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="telefono" value="<?= $contacto['telefono'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <button class="btn btn-sm btn-secondary" type="submit" name="actualizar_contacto"
                                            value="guardar">Guardar</button>
                                        <button class="btn btn-sm btn-secondary ml-2" type="button"
                                            onclick="ocultarFormulario(<?= $contacto['id_contacto'] ?>)">Cancelar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <script>
                            function ocultarFormulario(idContacto) {
                                const formRow = document.getElementById(`form_row_${idContacto}`);
                                formRow.style.display = 'none';
                            }
                        </script>


                    <?php endforeach; ?>

            </tbody>
        </table>
    </div>

  <!-- Formulario de editar-->
<div class="container mx-auto">
    <h2 class="text-center">Agregar Contacto</h2>
    <br>
    <form action="" method="post" class="d-flex justify-content-center align-items-center flex-wrap">
        <div class="form-group mx-2">
            <input type="text" class="form-control" name="nombre_contacto" placeholder="Nombre">
        </div>
        <div class="form-group mx-2">
            <input type="text" class="form-control" name="cargo" placeholder="Cargo">
        </div>
        <div class="form-group mx-2">
            <input type="text" class="form-control" name="correo" placeholder="Correo">
        </div>
        <div class="form-group mx-2">
            <input type="text" class="form-control" name="telefono" placeholder="Teléfono">
        </div>
        <div class="form-group mx-2">
            <button class="btn btn-sm btn-success" type="submit" name="agregar_contacto">Agregar Contacto</button>
        </div>
    </form>
</div>
<br>
<?php require_once "../vistas/modulos/footer.php"; ?>


</body>

</html>