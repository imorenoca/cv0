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

</head>

<body>
    <!-- Formulario para Agregar -->
    <div class="container">

        <form action="" method="post" class="row g-3 mt-3">
            <h2 class="">Agregar Contacto</h2>
            <div class="col-10">
                <label for="nombre_contacto" class="form-label">Nombre del Contacto</label>
                <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" required>
            </div>
            <div class="col-10">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" id="cargo" name="cargo" required>
            </div>
            <div class="col-10">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="col-10">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="col-10">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" id="empresa" name="empresa" required>
            </div>
            <div class="g-3 mt-3">
                <button type="submit" class="btn btn-success" name="agregar_contacto">Agregar Contacto</button>
                <button type="button" class="btn btn-warning"
          onclick="window.location.href='contacto.php'">Volver</button>
            </div>
        </form>

    </div>
    >
</body>

</html>