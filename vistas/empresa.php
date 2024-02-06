<?php
require_once '../controladores/empresacontrolador.php';
require_once '../modelos/empresamodelo.php';
require_once ('../middlewares/Middleware.php');
Middleware::verificarSesion();


// Procesamiento para agregar una nueva empresa si se envió el formulario
if (isset($_POST['agregar_empresa'])) {
    $nombre_empresa = $_POST['nombre_empresa'];
    $web_empresa = $_POST['web_empresa'];

    $controladorEmpresas = new EmpresaControlador();
    $controladorEmpresas->agregarEmpresa($nombre_empresa, $web_empresa);
    echo "<script>alert('Empresa agregada');</script>";
}

/*if (isset($_POST['eliminar_empresa'])) {
    $id_empresa_a_eliminar = $_POST['id_empresa_a_eliminar'];

    $id_empresa_a_eliminar = $_POST['id_empresa_a_eliminar'];

    $modeloEmpresas = new EmpresaModelo();

    $empresaAsociadaOferta = $modeloEmpresas->empresaEstaAsociadaAOferta($id_empresa_a_eliminar);
}*/

if (isset($_POST['eliminar_empresa'])) {
    $id_empresa_a_eliminar = $_POST['id_empresa_a_eliminar'];

    $modeloEmpresas = new EmpresaModelo();

    $empresaAsociadaOferta = $modeloEmpresas->empresaEstaAsociadaAOferta($id_empresa_a_eliminar);

    if ($empresaAsociadaOferta) {
        echo "<script>alert('No se puede eliminar la empresa, está asociada a una oferta.');</script>";
    } else {
        $controladorEmpresas = new EmpresaControlador();
        $controladorEmpresas->eliminarEmpresa($id_empresa_a_eliminar);
        echo "<script>alert('Empresa eliminada');</script>";
    }
}



if (isset($_POST['actualizar_empresa'])) {
    // Recoger los datos del formulario
    $id_empresa = $_POST['id_empresa'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $web_empresa = $_POST['web'];
    // var_dump($_POST);
    // Llamar al método para actualizar la empresa en el controlador
    $controlador = new EmpresaControlador();
    $actualizacion_exitosa = $controlador->actualizarEmpresa($id_empresa, $nombre_empresa, $web_empresa);

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
        function editarEmpresa(idEmpresa) {
            // Ocultar todos los formularios de edición
            const forms = document.querySelectorAll('[id^="form_row_"]');
            forms.forEach(form => {
                form.style.display = 'none';
            });

            // Mostrar el formulario de edición correspondiente
            const formToShow = document.getElementById('form_row_' + idEmpresa);
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

                    <a class="nav-link active text-primary" aria-current="page" href="">Empresas</a>
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
    <div class="container text-center">
        <h1 class="text-center">Empresas</h1>
        <div class="table-responsive d-inline-block mx-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Web</th>
                        <th scope="col">Acciones</th> <!-- Agregamos una columna para acciones -->

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Crear una instancia del controlador
                    $controladorEmpresas = new EmpresaControlador();

                    // Llamar a la función de empresa
                    $empresas = $controladorEmpresas->mostrarEmpresas();

                    // Mostrar las empresas en la tabla
                    
                    // Lógica para mostrar las empresas en la tabla
                    foreach ($empresas as $empresa): ?>
                        <tr>
                            <!-- Mostrar datos de la empresa en la tabla -->
                            <td>
                                <?= $empresa['nombre_empresa'] ?>
                            </td>
                            <td>
                                <?= $empresa['web'] ?>
                            </td>
                            <td>
                                <div>
                                <button class="btn btn-primary btn-sm"
                                        onclick="editarEmpresa(<?= $empresa['id_empresa'] ?>)">Editar</button>
                                    <form action="" method="post" class="d-inline">
                                        <input type="hidden" name="id_empresa_a_eliminar"
                                            value="<?= $empresa['id_empresa'] ?>">
                                        <button class="btn btn-danger btn-sm" type="submit"
                                            name="eliminar_empresa">Eliminar</button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                        <!-- Formulario de guardar-->
                        <tr id="form_row_<?= $empresa['id_empresa'] ?>" style="display: none;">
                            <td colspan="4">
                                <form action="" method="post"
                                    class="container mx-auto d-flex justify-content-center align-items-center flex-wrap">
                                    <div class="form-group mx-2">
                                        <input type="hidden" name="id_empresa" value="<?= $empresa['id_empresa'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="nombre_empresa"
                                            value="<?= $empresa['nombre_empresa'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <input type="text" class="form-control" name="web" value="<?= $empresa['web'] ?>">
                                    </div>
                                    <div class="form-group mx-2">
                                        <button class="btn btn-sm btn-secondary" type="submit" name="actualizar_empresa"
                                            value="guardar">Guardar</button>
                                        <button class="btn btn-sm btn-secondary ml-2" type="button"
                                            onclick="ocultarFormulario(<?= $empresa['id_empresa'] ?>)">Cancelar</button>
                                    </div>
                                </form>
                            </td>
                        </tr>

                        <script>
                            function ocultarFormulario(idEmpresa) {
                                const formRow = document.getElementById(`form_row_${idEmpresa}`);
                                formRow.style.display = 'none';
                            }
                        </script>


                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulario para agregar nueva empresa -->
    <div class="container mx-auto">
        <h2 class="text-center">Agregar Empresa</h2>
        <br>
        <form action="" method="post" class="d-flex justify-content-center align-items-center flex-wrap">
            <div class="form-group mx-2">
                <input type="text" class="form-control" name="nombre_empresa" placeholder="Nombre de la empresa">
            </div>
            <div class="form-group mx-2">
                <input type="text" class="form-control" name="web_empresa" placeholder="Sitio web de la empresa">
            </div>
            <div class="form-group mx-2">
                <button class="btn btn-sm btn-success" type="submit" name="agregar_empresa">Agregar Empresa</button>
            </div>
        </form>
    </div>
    <br>
    <?php require_once "../vistas/modulos/footer.php"; ?>
</body>

</html>